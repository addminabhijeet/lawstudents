<?php

namespace App\Helpers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryHelper
{
    /**
     * Get breadcrumb path for a category
     * Example: "Law > Constitutional Law > Fundamental Rights"
     *
     * @param int|Category $categoryId
     * @return string
     */
    public static function getBreadcrumb($categoryId): string
    {
        $breadcrumb = [];

        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        while ($category) {
            array_unshift($breadcrumb, $category->name);
            $category = $category->parent;
        }

        return implode(' > ', $breadcrumb);
    }

    /**
     * Get breadcrumb as HTML links
     *
     * @param int|Category $categoryId
     * @param string $routeName Route name for category links
     * @return string HTML
     */
    public static function getBreadcrumbHtml($categoryId, string $routeName = 'frontend.courses'): string
    {
        $breadcrumb = [];

        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        while ($category) {
            array_unshift($breadcrumb, [
                'name' => $category->name,
                'id' => $category->id,
                'slug' => $category->slug
            ]);
            $category = $category->parent;
        }

        $html = '<nav class="breadcrumb">';
        foreach ($breadcrumb as $index => $item) {
            if ($index === count($breadcrumb) - 1) {
                $html .= '<span class="breadcrumb-item active">' . e($item['name']) . '</span>';
            } else {
                $html .= '<a class="breadcrumb-item" href="' . route($routeName, ['category' => $item['id']]) . '">' . e($item['name']) . '</a>';
            }
        }
        $html .= '</nav>';

        return $html;
    }

    /**
     * Get full category hierarchy as array
     *
     * @param int|Category $categoryId
     * @return array
     */
    public static function getHierarchyArray($categoryId): array
    {
        $hierarchy = [];

        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        while ($category) {
            array_unshift($hierarchy, [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'parent_id' => $category->parent_id
            ]);
            $category = $category->parent;
        }

        return $hierarchy;
    }

    /**
     * Get category level (depth in hierarchy)
     * Level 0 = root category
     *
     * @param int|Category $categoryId
     * @return int
     */
    public static function getLevel($categoryId): int
    {
        $level = 0;

        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        while ($category->parent) {
            $level++;
            $category = $category->parent;
        }

        return $level;
    }

    /**
     * Get all child category IDs recursively
     *
     * @param int|Category $categoryId
     * @return array
     */
    public static function getAllChildIds($categoryId): array
    {
        $ids = [];

        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        if (!$category) {
            return $ids;
        }

        $ids[] = $category->id;

        foreach ($category->children as $child) {
            $ids = array_merge($ids, self::getAllChildIds($child));
        }

        return $ids;
    }

    /**
     * Get all courses under a category (including nested)
     *
     * @param int|Category $categoryId
     * @return Collection
     */
    public static function getAllCourses($categoryId)
    {
        $ids = self::getAllChildIds($categoryId);

        return \App\Models\Course::whereIn('category_id', $ids)
            ->where('status', 1)
            ->where('delete', 1)
            ->get();
    }

    /**
     * Get root category for a given category
     *
     * @param int|Category $categoryId
     * @return Category|null
     */
    public static function getRootCategory($categoryId)
    {
        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        if (!$category) {
            return null;
        }

        while ($category->parent) {
            $category = $category->parent;
        }

        return $category;
    }

    /**
     * Get all siblings of a category
     *
     * @param int|Category $categoryId
     * @return Collection
     */
    public static function getSiblings($categoryId)
    {
        if ($categoryId instanceof Category) {
            $category = $categoryId;
        } else {
            $category = Category::find($categoryId);
        }

        if (!$category) {
            return collect();
        }

        if ($category->parent_id) {
            return $category->parent->children();
        }

        return Category::whereNull('parent_id')
            ->where('status', 1)
            ->where('delete', 1)
            ->get();
    }

    /**
     * Build select tree options HTML
     * Used for form selects
     *
     * @param int|null $parentId Parent ID to start from (null = root)
     * @param int|null $selectedId Currently selected category ID
     * @param int $depth Current depth
     * @return string HTML
     */
    public static function buildSelectOptions($parentId = null, $selectedId = null, $depth = 0): string
    {
        $query = Category::where('status', 1)
            ->where('delete', 1)
            ->orderBy('sort_order');

        if ($parentId === null) {
            $query->whereNull('parent_id');
        } else {
            $query->where('parent_id', $parentId);
        }

        $categories = $query->get();
        $html = '';

        foreach ($categories as $category) {
            $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $depth);
            $prefix = $depth > 0 ? str_repeat('—&nbsp;', $depth) : '';
            $selected = $category->id == $selectedId ? ' selected' : '';

            $html .= '<option value="' . $category->id . '"' . $selected . '>'
                  . $indent . $prefix . e($category->name)
                  . '</option>';

            // Recursively add children
            $html .= self::buildSelectOptions($category->id, $selectedId, $depth + 1);
        }

        return $html;
    }

    /**
     * Check if category is ancestor of another category
     *
     * @param int|Category $ancestorId
     * @param int|Category $descendantId
     * @return bool
     */
    public static function isAncestor($ancestorId, $descendantId): bool
    {
        if ($ancestorId instanceof Category) {
            $ancestorId = $ancestorId->id;
        }
        if ($descendantId instanceof Category) {
            $descendantId = $descendantId->id;
        }

        $category = Category::find($descendantId);

        while ($category->parent) {
            if ($category->parent_id == $ancestorId) {
                return true;
            }
            $category = $category->parent;
        }

        return false;
    }

    /**
     * Get category tree with counts
     * Useful for admin dashboard
     *
     * @param int|null $parentId
     * @return array
     */
    public static function getTreeWithCounts($parentId = null): array
    {
        $query = Category::with(['children', 'courses'])
            ->where('status', 1)
            ->where('delete', 1)
            ->orderBy('sort_order');

        if ($parentId === null) {
            $query->whereNull('parent_id');
        } else {
            $query->where('parent_id', $parentId);
        }

        $categories = $query->get();
        $tree = [];

        foreach ($categories as $category) {
            $tree[] = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'courses_count' => $category->courses->count(),
                'subcategories_count' => $category->children->count(),
                'children' => self::getTreeWithCounts($category->id)
            ];
        }

        return $tree;
    }
}
