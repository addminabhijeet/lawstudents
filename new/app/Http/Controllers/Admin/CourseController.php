<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ActCategory;
use App\Models\ActSubcategory;
use App\Models\RuleCategory;
use App\Models\RuleSubcategory;
use App\Models\Course;
use App\Models\Clientele;
use App\Models\Act;
use App\Models\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\User;
use App\Models\Gallery;
use App\Models\MailSetting;
use App\Models\Copy;
use App\Models\CopyCategory;
use App\Models\CopySubcategory;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentOtpMail;
use App\Models\StudentActivity;
use App\Models\StudentAdmission;
use App\Models\Payment;
use Carbon\Carbon;

class CourseController extends Controller
{

    public function listcourse()
    {
        // Load only root categories with full hierarchy
        $categories = Category::with([
            'courses' => function ($query) {
                $query->where('delete', 1);
            },
            'children' => function ($query) {
                $query->where('status', 1)->where('delete', 1);
            }
        ])
            ->where('delete', 1)
            ->whereNull('parent_id')  // Only root categories
            ->orderBy('sort_order')
            ->get();

        return view('course.list', compact('categories'));
    }

    public function listcoursecategory()
    {
        // Fetch all root categories with full hierarchy for display
        $allCategories = Category::with([
            'courses' => function ($query) {
                $query->where('delete', 1);
            },
            'children' => function ($query) {
                $query->where('status', 1)->where('delete', 1);
            }
        ])
            ->where('delete', 1)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        // Paginate for table display
        $categories = Category::where('delete', 1)
            ->paginate(10);

        return view('course.listcategory', compact('categories', 'allCategories'));
    }

    public function listcoursesubcategory()
    {
        $categories = Category::with([
            'courses' => function ($query) {
                $query->where('delete', 1);
            },
            'children' => function ($query) {
                $query->where('status', 1)->where('delete', 1);
            }
        ])
            ->where('delete', 1)
            ->orderBy('sort_order')
            ->paginate(10);

        return view('course.listsubcategory', compact('categories'));
    }

    public function editcourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }

        return response()->json($course);
    }

    public function listclientele()
    {
        $clienteles = Clientele::where('delete', 0)->paginate(10);
        return view('clientele.list', compact('clienteles'));
    }

    public function addclientele()
    {

        return view('clientele.add');
    }

    public function storeclientele(Request $request)
    {
        $request->validate([
            'pdf' => ['required'],
            'pdf.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('pdf')) {
            foreach ($request->file('pdf') as $file) {
                // Keep the original file name
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('clientele', $originalName, 'public');

                Clientele::create([
                    'pdfs' => $path,
                    'description' => $request->description,
                ]);
            }
        }

        return redirect()->route('admin.listclientele')
            ->with('success', 'Client PDFs uploaded successfully.');
    }

    public function editclientele($id)
    {
        $clientele = Clientele::findOrFail($id);
        return view('clientele.edit', compact('clientele'));
    }

    public function updateclientele(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string',
            'pdfs.*' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
        ]);

        $clientele = Clientele::findOrFail($id);

        // Update PDFs if new files are uploaded
        if ($request->hasFile('pdfs')) {
            $pdfPaths = [];

            foreach ($request->file('pdfs') as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('clientele', $originalName, 'public');
                $pdfPaths[] = $path;
            }

            // Save as JSON if multiple PDFs
            $clientele->pdfs = json_encode($pdfPaths);
        }

        // Update description
        $clientele->description = $request->description ?? $clientele->description;

        $clientele->save();

        return redirect()->route('admin.listclientele')
            ->with('success', 'Client PDFs updated successfully.');
    }
    public function clientelefiledelete(Request $request, $id)
    {
        $clientele = Clientele::findOrFail($id);

        // ✅ Soft delete (update column instead of removing data)
        $clientele->update([
            'delete' => 1
        ]);

        return back()->with('success', 'Client deleted successfully.');
    }

    public function listacts()
    {
        $actss = Act::with(['category', 'subcategory'])
            ->where('delete', 1) // filter acts
            ->latest()
            ->paginate(10);

        return view('acts.list', compact('actss'));
    }

    public function addacts()
    {
        // Eager load subcategories for all categories
        $categories = ActCategory::with('subcategories')->get();
        return view('acts.add', compact('categories'));
    }
    public function storeacts(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:act_categories,id',
            'subcategory_id' => 'required|exists:act_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('acts', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        Act::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listacts')
            ->with('success', 'PDFs uploaded successfully.');
    }

    public function editacts($id)
    {
        $acts = Act::findOrFail($id);

        // Eager load subcategories for all categories
        $categories = ActCategory::with('subcategories')->get();

        return view('acts.edit', compact('acts', 'categories'));
    }

    public function updateacts(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:act_categories,id',
            'subcategory_id' => 'required|exists:act_subcategories,id',
            'pdfs' => ['nullable', 'array'], // same as store but optional
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $acts = Act::findOrFail($id);

        // ✅ Keep existing PDFs
        $pdfPaths = $acts->pdfs ?? [];

        // ✅ SAME LOGIC AS STORE (only addition)
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('acts', $filename, 'public');
                $pdfPaths[] = $path; // append like store
            }
        }

        $acts->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listacts')
            ->with('success', 'Acts updated successfully.');
    }

    public function deleteaddfile($id, $key)
    {
        $act = Act::findOrFail($id);

        // Soft delete using delete column
        $act->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Record deleted successfully');
    }

    public function actsfiledelete(Request $request, $id)
    {
        $acts = Act::findOrFail($id);

        $acts->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Act deleted successfully.');
    }

    public function listactcategories()
    {
        $categories = ActCategory::where('delete', 1)->latest()->paginate(10);
        return view('acts.categories.list', compact('categories'));
    }

    // Show form to add new category
    public function addactcategory()
    {
        return view('acts.categories.add');
    }

    // Store new category
    public function storeactcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ActCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.listactcategories')->with('success', 'Category created successfully.');
    }

    // Show edit form
    public function editactcategory($id)
    {
        $categories = ActCategory::findOrFail($id);
        return view('acts.categories.edit', compact('categories'));
    }

    // Update category
    public function updateactcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = ActCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listactcategories')->with('success', 'Category updated successfully.');
    }

    // Delete a specific PDF from category
    public function deleteactcategoryfile(Request $request, $id)
    {
        $categories = ActCategory::findOrFail($id);

        // Set delete column to 0 (soft delete)
        $categories->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Category deleted successfully.');
    }

    public function listrulescategories()
    {
        $categories = RuleCategory::where('delete', 1) // filter visible categories
            ->latest()
            ->paginate(10);

        return view('rules.categories.list', compact('categories'));
    }

    public function addrulescategory()
    {
        return view('rules.categories.add');
    }

    public function storerulescategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        RuleCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.listrulescategories')
            ->with('success', 'Rule category created successfully.');
    }

    public function editrulescategory($id)
    {
        $categories = RuleCategory::findOrFail($id);
        return view('rules.categories.edit', compact('categories'));
    }

    public function updaterulescategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = RuleCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listrulescategories')
            ->with('success', 'Rule category updated successfully.');
    }


    public function deleterulescategoryfile(Request $request, $id)
    {
        $categories = RuleCategory::findOrFail($id);

        // Only mark as deleted
        $categories->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Category deleted successfully.');
    }

    public function listactsubcategories()
    {
        $subcategories = ActSubcategory::with('category')
            ->where('delete', 1)
            ->latest()
            ->paginate(10);

        return view('acts.subcategories.list', compact('subcategories'));
    }

    public function addactsubcategory()
    {
        $categories = ActCategory::all();
        return view('acts.subcategories.add', compact('categories'));
    }

    public function storeactsubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'act_category_id' => 'required|exists:act_categories,id',
        ]);

        ActSubcategory::create([
            'name' => $request->name,
            'act_category_id' => $request->act_category_id,
        ]);

        return redirect()->route('admin.listactsubcategories')
            ->with('success', 'Act subcategory created successfully.');
    }
    // Show edit form
    public function editactsubcategory($id)
    {
        $subcategories = ActSubcategory::findOrFail($id);
        $categories = ActCategory::all();
        return view('acts.subcategories.edit', compact('subcategories', 'categories'));
    }

    // Update subcategory
    public function updateactsubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'act_category_id' => 'required|exists:act_categories,id',
        ]);

        $subcategory = ActSubcategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->act_category_id = $request->act_category_id;
        $subcategory->save();

        return redirect()->route('admin.listactsubcategories')
            ->with('success', 'Act subcategory updated successfully.');
    }

    public function deleteactsubcategoryfile(Request $request, $id)
    {
        $categories = ActSubcategory::findOrFail($id);

        // Set delete column to 0 (soft delete)
        $categories->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Category deleted successfully.');
    }

    public function listrulessubcategories()
    {
        $subcategories = RuleSubcategory::with('category')
            ->where('delete', 1) // filter subcategories
            ->latest()
            ->paginate(10);

        return view('rules.subcategories.list', compact('subcategories'));
    }

    // Show add form
    public function addrulessubcategory()
    {
        $categories = RuleCategory::all();
        return view('rules.subcategories.add', compact('categories'));
    }

    // Store subcategory with correct rule_category_id
    public function storerulessubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rule_category_id' => 'required|exists:rule_categories,id',
        ]);

        RuleSubcategory::create([
            'name' => $request->name,
            'rule_category_id' => $request->rule_category_id,
        ]);

        return redirect()->route('admin.listrulessubcategories')
            ->with('success', 'Rule subcategory created successfully.');
    }

    public function editrulessubcategory($id)
    {
        $subcategories = RuleSubcategory::findOrFail($id);
        $categories = RuleCategory::all();
        return view('rules.subcategories.edit', compact('subcategories', 'categories'));
    }

    public function updaterulessubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rule_category_id' => 'required|exists:rule_categories,id',
        ]);

        $subcategories = RuleSubcategory::findOrFail($id);
        $subcategories->name = $request->name;
        $subcategories->rule_category_id = $request->rule_category_id;
        $subcategories->save();

        return redirect()->route('admin.listrulessubcategories')
            ->with('success', 'Rule subcategory updated successfully.');
    }

    public function deleterulessubcategoryfile(Request $request, $id)
    {
        $subcategory = RuleSubcategory::findOrFail($id);

        // Only mark as deleted without modifying PDFs
        $subcategory->update(['delete' => 0]);

        return back()->with('success', 'Subcategory deleted successfully.');
    }

    public function listrules()
    {
        $ruless = Rule::with('category', 'subcategory')->where('delete', 1)->latest()->paginate(10);
        return view('rules.list', compact('ruless'));
    }

    public function addrules()
    {
        // SAME as Acts
        $categories = RuleCategory::with('subcategories')->get();

        return view('rules.add', compact('categories'));
    }

    public function storerules(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:rule_categories,id',
            'subcategory_id' => 'required|exists:rule_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('rules', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        Rule::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listrules')
            ->with('success', 'Rules PDFs uploaded successfully.');
    }

    public function editrules($id)
    {
        $rules = Rule::findOrFail($id);

        // Load categories like ADD
        $categories = RuleCategory::with('subcategories')->get();

        return view('rules.edit', compact('rules', 'categories'));
    }
    public function updaterules(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required|exists:rule_categories,id',
            'subcategory_id' => 'required|exists:rule_subcategories,id',
            'pdfs' => ['nullable', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf', 'max:10240'],
            'description' => ['nullable', 'string'],
        ]);

        $rules = Rule::findOrFail($id);

        // Start with existing PDFs
        $pdfPaths = $rules->pdfs ?? [];

        // Add new PDFs if uploaded
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('rules', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        $rules->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths, // ✅ NO json_encode
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listrules')
            ->with('success', 'Rules updated successfully.');
    }

    public function rulesfiledelete(Request $request, $id)
    {
        $rules = Rule::findOrFail($id);

        // Soft delete using delete column
        $rules->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Rule deleted successfully.');
    }


    public function listbanner()
    {
        $banner = Banner::first();

        return view('course.banner', compact('banner'));
    }

    public function mailsetting()
    {
        $mailsetting = MailSetting::first();
        return view('course.mailsetting', compact('mailsetting'));
    }

    public function updatemailsetting(Request $request, $id)
    {
        $data = $request->validate([
            'mail_host'       => 'required|string',
            'mail_port'       => 'required|numeric',
            'mail_username'   => 'required|string',
            'mail_password'   => 'required|string',
            'mail_encryption' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name'    => 'required|string',
        ]);

        MailSetting::updateOrCreate(
            ['id' => $id],
            $data
        );

        return back()->with('success', 'Mail settings updated successfully');
    }

    public function listgallery()
    {
        $gallery = Gallery::latest()->get()->groupBy('group_name'); // ✅ grouped
        $groups = Gallery::select('group_name')->distinct()->pluck('group_name');

        return view('course.gallery', compact('gallery', 'groups'));
    }

    public function storegallery(Request $request)
    {
        $request->validate([
            'image' => ['required'],
            'image.*' => ['image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'group_name' => ['nullable', 'string'],
            'new_group' => ['nullable', 'string'],
        ]);

        $group = $request->new_group ?: $request->group_name;

        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $file) {

                $path = $file->store('gallery', 'public');

                Gallery::create([
                    'image' => $path,
                    'description' => $request->description,
                    'group_name' => $group,
                    'status' => 1,
                    'order' => 0,
                ]);
            }
        }

        return back()->with('success', 'Gallery images uploaded successfully.');
    }

    public function editgallery($id)
    {
        $gallery = Gallery::latest()->get()->groupBy('group_name'); // ✅ FIXED
        $groups = Gallery::select('group_name')->distinct()->pluck('group_name'); // ✅ FIXED
        $editItem = Gallery::findOrFail($id);

        return view('course.gallery', compact('gallery', 'editItem', 'groups'));
    }

    public function updategallery(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);

        $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'group_name' => ['nullable', 'string'],
            'new_group' => ['nullable', 'string'], // ✅ FIXED
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $item->image = $path;
        }

        $group = $request->new_group ?: $request->group_name; // ✅ FIXED

        $item->group_name = $group;
        $item->description = $request->description;
        $item->save();

        return redirect()->back()->with('success', 'Gallery updated successfully.');
    }

    public function deletegallery($id)
    {
        $item = Gallery::findOrFail($id);

        // Soft delete using delete column
        $item->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Gallery item deleted successfully.');
    }

    public function admindetails()
    {
        $admin = User::first();

        return view('course.admin', compact('admin'));
    }

    public function updatedetails(Request $request, $id)
    {
        $gallery = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $gallery->image = $path;
        }

        if ($request->hasFile('accsign')) {
            $path = $request->file('accsign')->store('gallery', 'public');
            $gallery->accsign = $path;
        }

        if ($request->hasFile('diraccsign')) {
            $path = $request->file('diraccsign')->store('gallery', 'public');
            $gallery->diraccsign = $path;
        }

        $gallery->update([
            'description' => $request->description,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'webemail' => $request->webemail,
            'webaddress' => $request->webaddress,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'pinterest' => $request->pinterest,
            'twitter' => $request->twitter,
            'defaultpass' => $request->defaultpass,
            'centerone' => $request->centerone,
            'centertwo' => $request->centertwo,
            'terms' => $request->terms,

        ]);

        return back()->with('success', 'Admin updated successfully');
    }
    public function storebanner(Request $request)
    {
        $request->validate([
            'image_1' => ['nullable', 'image', 'dimensions:width=1920,height=1080'],
            'image_2' => ['nullable', 'image', 'dimensions:width=1920,height=1080'],
            'image_3' => ['nullable', 'image', 'dimensions:width=1920,height=1080'],
        ], [
            'image_1.dimensions' => 'Image 1 must be exactly 1920 x 1080 pixels.',
            'image_2.dimensions' => 'Image 2 must be exactly 1920 x 1080 pixels.',
            'image_3.dimensions' => 'Image 3 must be exactly 1920 x 1080 pixels.',
        ]);

        $banner = Banner::first();

        if (!$banner) {
            return back()->with('error', 'No banner found to update.');
        }

        if ($request->hasFile('image_1')) {
            $banner->image_1 = $request->file('image_1')->store('banners', 'public');
        }

        if ($request->hasFile('image_2')) {
            $banner->image_2 = $request->file('image_2')->store('banners', 'public');
        }

        if ($request->hasFile('image_3')) {
            $banner->image_3 = $request->file('image_3')->store('banners', 'public');
        }

        $banner->save();

        return back()->with('success', 'Banner updated successfully.');
    }

    public function storecategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id'
        ], [
            'name.unique' => 'This category already exists.'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Category Created Successfully');
    }

    public function editCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Soft delete using delete column
        $category->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Category deleted successfully');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Category Updated Successfully');
    }

    public function storecourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|unique:courses,title',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',

            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'title.unique' => 'This course already exists.'
        ]);

        $brochurePath = null;
        $thumbnailPath = null;

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $brochurePath,
            'thumbnail' => $thumbnailPath,
        ]);

        return back()->with('success', 'Course Created Successfully');
    }

    public function updatecourse(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return back()->with('error', 'Course not found');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',

            // SAME VALIDATION (no change)
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle brochure update
        if ($request->hasFile('brochure')) {
            // delete old brochure (optional but recommended)
            if ($course->brochure && Storage::disk('public')->exists($course->brochure)) {
                Storage::disk('public')->delete($course->brochure);
            }

            $brochurePath = $request->file('brochure')->store('brochures', 'public');
            $course->brochure = $brochurePath;
        }

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // delete old thumbnail
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $course->thumbnail = $thumbnailPath;
        }

        // Update data (same structure as store)
        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,

            // NEW FIELDS
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $course->brochure,
            'thumbnail' => $course->thumbnail,
        ]);

        return back()->with('success', 'Course Updated Successfully');
    }

    public function coursedelete(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Course Deleted Successfully');
    }

    // DELETE COURSE
    public function deletecourse($id)
    {
        $course = Course::findOrFail($id);
        $course->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Course Deleted Successfully');
    }


    public function listcopys()
    {
        $copyss = Copy::with(['category', 'subcategory'])
            ->where('delete', 1) // filter copies
            ->latest()
            ->paginate(10);

        return view('copys.list', compact('copyss'));
    }

    public function addcopys()
    {
        // Eager load subcategories for all categories
        $categories = CopyCategory::with('subcategories')->get();
        return view('copys.add', compact('categories'));
    }
    public function storecopys(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:copy_categories,id',
            'subcategory_id' => 'required|exists:copy_subcategories,id',
            'pdfs' => ['required', 'array'],
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $pdfPaths = [];

        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('copys', $filename, 'public');
                $pdfPaths[] = $path;
            }
        }

        Copy::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listcopys')
            ->with('success', 'PDFs uploaded successfully.');
    }

    public function editcopys($id)
    {
        $copys = Copy::findOrFail($id);

        // Eager load subcategories for all categories
        $categories = CopyCategory::with('subcategories')->get();

        return view('copys.edit', compact('copys', 'categories'));
    }

    public function updatecopys(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:copy_categories,id',
            'subcategory_id' => 'required|exists:copy_subcategories,id',
            'pdfs' => ['nullable', 'array'], // same as store but optional
            'pdfs.*' => ['file', 'mimes:pdf'],
            'description' => ['nullable', 'string'],
        ]);

        $copys = Copy::findOrFail($id);

        // ✅ Keep existing PDFs
        $pdfPaths = $copys->pdfs ?? [];

        // ✅ SAME LOGIC AS STORE (only addition)
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('copys', $filename, 'public');
                $pdfPaths[] = $path; // append like store
            }
        }

        $copys->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'pdfs' => $pdfPaths,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.listcopys')
            ->with('success', 'Copys updated successfully.');
    }

    public function deletecopyfile($id, $key)
    {
        $copy = Copy::findOrFail($id);

        // Soft delete using delete column
        $copy->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Record deleted successfully');
    }

    public function copysfiledelete(Request $request, $id)
    {
        $copys = Copy::findOrFail($id);

        // Only mark as deleted (soft delete)
        $copys->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Record deleted successfully.');
    }

    // List all copy categories
    public function listcopyscategories()
    {
        $categories = CopyCategory::where('delete', 1) // filter visible categories
            ->latest()
            ->paginate(10);

        return view('copys.categories.list', compact('categories'));
    }

    // Show form to add new category
    public function addcopyscategory()
    {
        return view('copys.categories.add');
    }

    // Store new category
    public function storecopyscategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CopyCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.listcopyscategories')->with('success', 'Category created successfully.');
    }

    // Show edit form
    public function editcopyscategory($id)
    {
        $categories = CopyCategory::findOrFail($id);
        return view('copys.categories.edit', compact('categories'));
    }

    // Update category
    public function updatecopyscategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = CopyCategory::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->route('admin.listcopyscategories')->with('success', 'Category updated successfully.');
    }

    public function deletecopyscategoryfile(Request $request, $id)
    {
        $subcategory = CopyCategory::findOrFail($id);

        // Soft delete using delete column
        $subcategory->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Subcategory deleted successfully.');
    }

    // List all copy subcategories
    public function listcopyssubcategories()
    {
        $subcategories = CopySubcategory::with('category')
            ->where('delete', 1) // filter subcategories
            ->latest()
            ->paginate(10);

        return view('copys.subcategories.list', compact('subcategories'));
    }

    // Show form to add new subcategory
    public function addcopyssubcategory()
    {
        $categories = CopyCategory::all();
        return view('copys.subcategories.add', compact('categories'));
    }

    public function storecopyssubcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'copy_category_id' => 'required|exists:copy_categories,id',
        ]);

        CopySubcategory::create([
            'name' => $request->name,
            'copy_category_id' => $request->copy_category_id,
        ]);

        return redirect()->route('admin.listcopyssubcategories')
            ->with('success', 'Copy subcategory created successfully.');
    }
    // Show edit form
    public function editcopyssubcategory($id)
    {
        $subcategories = CopySubcategory::findOrFail($id);
        $categories = CopyCategory::all();
        return view('copys.subcategories.edit', compact('subcategories', 'categories'));
    }

    // Update subcategory
    public function updatecopyssubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'copy_category_id' => 'required|exists:copy_categories,id',
        ]);

        $subcategory = CopySubcategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->copy_category_id = $request->copy_category_id;
        $subcategory->save();

        return redirect()->route('admin.listcopyssubcategories')
            ->with('success', 'Copy subcategory updated successfully.');
    }

    // Delete a specific PDF from subcategory
    public function deletecopyssubcategoryfile(Request $request, $id)
    {
        $subcategory = CopySubcategory::findOrFail($id);

        // Soft delete using delete column
        $subcategory->update([
            'delete' => 0
        ]);

        return back()->with('success', 'Subcategory deleted successfully.');
    }

    public function listcontactform()
    {
        $contact = ContactForm::where('delete', 1)->latest()->paginate(10);
        return view('contact.list', compact('contact'));
    }

    public function viewcontactform($id)
    {
        $contact = ContactForm::findOrFail($id);
        return view('contact.view', compact('contact'));
    }

    public function sendMail($id)
    {
        $data = ContactForm::findOrFail($id);
        $otp = rand(100000, 999999);
        Mail::to($data->email)->send(new StudentOtpMail($otp));
        return back()->with('success', 'Mail sent successfully!');
    }

    public function deletecontact($id)
    {
        $data = ContactForm::findOrFail($id);
        $data->update(['delete' => 0]);

        return back()->with('success', 'Deleted successfully!');
    }

    public function liststudentactivity()
    {
        $admissions = StudentAdmission::where('deleted', 0)
            ->latest()
            ->paginate(10);
        return view('student.listactivity', compact('admissions'));
    }


    public function viewstudentactivity($studentId)
    {
        $student = \App\Models\Student::findOrFail($studentId);

        $payments = Payment::where('student_id', $student->id)
            ->where('payment_status', 'paid')
            ->whereMonth('issue_date', Carbon::now()->month)
            ->whereYear('issue_date', Carbon::now()->year)
            ->pluck('course_id');

        $paidCourseIds = [];
        foreach ($payments as $courseIdsString) {
            if ($courseIdsString) {
                $ids = explode(',', $courseIdsString);
                $paidCourseIds = array_merge($paidCourseIds, $ids);
            }
        }

        $paidCourseIds = array_map('intval', $paidCourseIds);
        $paidCourseIds = array_unique($paidCourseIds);

        if (empty($paidCourseIds)) {
            return view('student.viewactivity', [
                'courses' => collect(),
                'progressData' => []
            ]);
        }

        $courses = Course::with([
            'category',
            'notes' => function ($query) {
                $query->where('status', 1);
            }
        ])
            ->whereIn('id', $paidCourseIds)
            ->get();

        if ($courses->isEmpty()) {
            abort(404, 'Courses not found.');
        }

        // ✅ ADD THIS (progress for all courses)
        $progressData = \App\Models\NoteProgress::where('student_id', $student->id)
            ->whereIn('course_id', $paidCourseIds)
            ->selectRaw('course_id, AVG(progress_percent) as progress')
            ->groupBy('course_id')
            ->pluck('progress', 'course_id'); // [course_id => progress]

        // Activity log (unchanged)
        foreach ($courses as $course) {
            StudentActivity::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'activity_type' => 'view_course'
            ]);
        }

        return view('student.viewactivity', compact('courses', 'progressData'));
    }
}
