<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryApiController extends Controller
{
    /**
     * Get all root categories
     *
     * @return JsonResponse
     */
    public function getRoots(): JsonResponse
    {
        $categories = Category::whereNull('parent_id')
            ->where('status', 1)
            ->where('delete', 1)
            ->orderBy('sort_order')
            ->select('id', 'name', 'slug', 'icon')
            ->get();

        return response()->json($categories);
    }

    /**
     * Get child categories for a parent
     *
     * @param int $parentId
     * @return JsonResponse
     */
    public function getChildren($parentId): JsonResponse
    {
        $categories = Category::where('parent_id', $parentId)
            ->where('status', 1)
            ->where('delete', 1)
            ->orderBy('sort_order')
            ->select('id', 'name', 'slug', 'icon')
            ->get();

        return response()->json($categories);
    }

    /**
     * Get category with all its ancestors (breadcrumb)
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function getAncestors($categoryId): JsonResponse
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $ancestors = [];
        $current = $category;

        while ($current) {
            array_unshift($ancestors, [
                'id' => $current->id,
                'name' => $current->name,
                'slug' => $current->slug
            ]);
            $current = $current->parent;
        }

        return response()->json($ancestors);
    }

    /**
     * Get full category tree starting from root or specific parent
     *
     * @param Request $request
     * @param int|null $parentId
     * @return JsonResponse
     */
    public function getTree(Request $request, $parentId = null): JsonResponse
    {
        $categories = Category::where('status', 1)
            ->where('delete', 1)
            ->orderBy('sort_order');

        if ($parentId !== null) {
            $categories->where('parent_id', $parentId);
        } else {
            $categories->whereNull('parent_id');
        }

        $categories = $categories->with('children')
            ->get()
            ->map(function ($category) {
                return $this->formatCategoryWithChildren($category);
            });

        return response()->json($categories);
    }

    /**
     * Search categories by name
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $categories = Category::where('status', 1)
            ->where('delete', 1)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->select('id', 'name', 'slug', 'parent_id')
            ->limit(20)
            ->get()
            ->map(function ($category) {
                $breadcrumb = $this->getBreadcrumb($category);
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'breadcrumb' => $breadcrumb
                ];
            });

        return response()->json($categories);
    }

    /**
     * Get single category with metadata
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function getCategory($categoryId): JsonResponse
    {
        $category = Category::with(['parent', 'children', 'courses'])
            ->find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'icon' => $category->icon,
            'status' => $category->status,
            'parent_id' => $category->parent_id,
            'parent' => $category->parent ? [
                'id' => $category->parent->id,
                'name' => $category->parent->name
            ] : null,
            'children_count' => $category->children->count(),
            'courses_count' => $category->courses->count(),
            'children' => $category->children->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->name
            ])
        ]);
    }

    /**
     * Get all courses under a category (including nested)
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function getCourses($categoryId): JsonResponse
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $categoryIds = $this->getAllChildIds($category);

        $courses = \App\Models\Course::whereIn('category_id', $categoryIds)
            ->where('status', 1)
            ->where('delete', 1)
            ->select('id', 'title', 'slug', 'category_id', 'price', 'discount', 'thumbnail')
            ->get();

        return response()->json($courses);
    }

    /**
     * Get category statistics
     *
     * @return JsonResponse
     */
    public function getStats(): JsonResponse
    {
        $totalCategories = Category::where('delete', 1)->count();
        $activeCategories = Category::where('status', 1)->where('delete', 1)->count();
        $rootCategories = Category::whereNull('parent_id')->where('delete', 1)->count();

        $deepestLevel = 0;
        $this->findDeepestLevel(null, 0, $deepestLevel);

        return response()->json([
            'total_categories' => $totalCategories,
            'active_categories' => $activeCategories,
            'root_categories' => $rootCategories,
            'max_nesting_level' => $deepestLevel,
            'total_courses' => \App\Models\Course::where('delete', 1)->count()
        ]);
    }

    // ===== PRIVATE HELPER METHODS =====

    /**
     * Format category with nested children
     *
     * @param Category $category
     * @return array
     */
    private function formatCategoryWithChildren(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'icon' => $category->icon,
            'children' => $category->children->map(
                fn($child) => $this->formatCategoryWithChildren($child)
            )->values()
        ];
    }

    /**
     * Get breadcrumb for a category
     *
     * @param Category $category
     * @return string
     */
    private function getBreadcrumb(Category $category): string
    {
        $breadcrumb = [];

        while ($category) {
            array_unshift($breadcrumb, $category->name);
            $category = $category->parent;
        }

        return implode(' > ', $breadcrumb);
    }

    /**
     * Get all child category IDs recursively
     *
     * @param Category $category
     * @return array
     */
    private function getAllChildIds(Category $category): array
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllChildIds($child));
        }

        return $ids;
    }

    /**
     * Find the deepest nesting level
     *
     * @param int|null $parentId
     * @param int $currentLevel
     * @param int $deepestLevel
     * @return void
     */
    private function findDeepestLevel($parentId, $currentLevel, &$deepestLevel): void
    {
        $query = Category::where('delete', 1);

        if ($parentId === null) {
            $query->whereNull('parent_id');
        } else {
            $query->where('parent_id', $parentId);
        }

        $categories = $query->pluck('id')->toArray();

        if (empty($categories)) {
            $deepestLevel = max($deepestLevel, $currentLevel);
            return;
        }

        foreach ($categories as $categoryId) {
            $this->findDeepestLevel($categoryId, $currentLevel + 1, $deepestLevel);
        }
    }
}
