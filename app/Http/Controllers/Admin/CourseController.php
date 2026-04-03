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


class CourseController extends Controller
{

    public function listcourse()
    {
        $categories = Category::with('courses')
            ->get();

        return view('course.list', compact('categories'));
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
        $clienteles = Clientele::latest()->paginate(10);
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

        $fileToDelete = $request->input('file');

        if (!$fileToDelete) {
            return back()->with('error', 'No file specified for deletion.');
        }

        $pdfs = $clientele->pdfs ?? [];
        $updatedPdfs = [];

        foreach ($pdfs as $pdf) {
            if ($pdf['file'] !== $fileToDelete) {
                $updatedPdfs[] = $pdf;
            }
        }

        $clientele->update(['pdfs' => $updatedPdfs]);

        return back()->with('success', 'File deleted successfully.');
    }

    public function listacts()
    {
        $actss = Act::with('category', 'subcategory')->latest()->paginate(10);
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

        $pdfs = $act->pdfs;

        if (isset($pdfs[$key])) {
            // Delete file from storage
            Storage::delete('public/' . $pdfs[$key]);

            // Remove from array
            unset($pdfs[$key]);

            // Re-index array
            $act->pdfs = array_values($pdfs);
            $act->save();
        }

        return back()->with('success', 'PDF removed successfully');
    }

    public function actsfiledelete(Request $request, $id)
    {
        $acts = Act::findOrFail($id);
        $fileToDelete = $request->file;

        $pdfs = $acts->pdfs ?? [];

        $updated = [];

        foreach ($pdfs as $pdf) {
            if ($pdf != $fileToDelete) {
                $updated[] = $pdf;
            } else {
                Storage::disk('public')->delete($pdf);
            }
        }

        $acts->update([
            'pdfs' => $updated
        ]);

        return back()->with('success', 'File deleted successfully.');
    }

    // List all act categories
    public function listactcategories()
    {
        $categories = ActCategory::latest()->paginate(10);
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
    public function actcategoryfiledelete(Request $request, $id)
    {
        $categories = ActCategory::findOrFail($id);
        $fileToDelete = $request->input('file');

        if (!$fileToDelete) return back()->with('error', 'No file specified for deletion.');

        $pdfs = json_decode($categories->pdfs, true) ?? [];
        $updatedPdfs = array_filter($pdfs, fn($pdf) => $pdf !== $fileToDelete);

        $categories->update(['pdfs' => json_encode($updatedPdfs)]);
        return back()->with('success', 'File deleted successfully.');
    }

    public function listrulescategories()
    {
        $categories = RuleCategory::latest()->paginate(10);

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


    public function rulescategoryfiledelete(Request $request, $id)
    {
        $categories = RuleCategory::findOrFail($id);
        $fileToDelete = $request->input('file');

        if (!$fileToDelete) return back()->with('error', 'No file specified for deletion.');

        $pdfs = json_decode($categories->pdfs, true) ?? [];
        $updatedPdfs = array_filter($pdfs, fn($pdf) => $pdf !== $fileToDelete);

        $categories->update(['pdfs' => json_encode($updatedPdfs)]);
        return back()->with('success', 'File deleted successfully.');
    }

    // List all act subcategories
    public function listactsubcategories()
    {
        $subcategories = ActSubcategory::with('category')->latest()->paginate(10);
        return view('acts.subcategories.list', compact('subcategories'));
    }

    // Show form to add new subcategory
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

    // Delete a specific PDF from subcategory
    public function actsubcategoryfiledelete(Request $request, $id)
    {
        $subcategory = ActSubcategory::findOrFail($id);
        $fileToDelete = $request->input('file');

        if (!$fileToDelete) return back()->with('error', 'No file specified for deletion.');

        $pdfs = json_decode($subcategory->pdfs, true) ?? [];
        $updatedPdfs = array_filter($pdfs, fn($pdf) => $pdf !== $fileToDelete);

        $subcategory->update(['pdfs' => json_encode($updatedPdfs)]);
        return back()->with('success', 'File deleted successfully.');
    }

    public function listrulessubcategories()
    {
        $subcategories = RuleSubcategory::with('category')->latest()->paginate(10);
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

    public function rulessubcategoryfiledelete(Request $request, $id)
    {
        $subcategory = RuleSubcategory::findOrFail($id);
        $fileToDelete = $request->input('file');

        if (!$fileToDelete) return back()->with('error', 'No file specified for deletion.');

        $pdfs = json_decode($subcategory->pdfs, true) ?? [];
        $updatedPdfs = array_filter($pdfs, fn($pdf) => $pdf !== $fileToDelete);

        $subcategory->update(['pdfs' => json_encode($updatedPdfs)]);
        return back()->with('success', 'File deleted successfully.');
    }

    public function listrules()
    {
        $ruless = Rule::with('category', 'subcategory')->latest()->paginate(10);
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
        dd("HIT", $request->all());
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

        $fileToDelete = $request->input('file');

        if (!$fileToDelete) {
            return back()->with('error', 'No file specified for deletion.');
        }

        $pdfs = $rules->pdfs ?? [];
        $updatedPdfs = [];

        foreach ($pdfs as $pdf) {
            if ($pdf['file'] !== $fileToDelete) {
                $updatedPdfs[] = $pdf;
            }
        }

        $rules->update(['pdfs' => $updatedPdfs]);

        return back()->with('success', 'File deleted successfully.');
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
        $gallery = Gallery::latest()->get();
        return view('course.gallery', compact('gallery'));
    }

    public function storegallery(Request $request)
    {
        $request->validate([
            'image' => ['required'],
            'image.*' => ['image', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $file) {

                $path = $file->store('gallery', 'public');

                Gallery::create([
                    'image' => $path,
                    'description' => $request->description,
                    'status' => 1,
                    'order' => 0,
                ]);
            }
        }

        return back()->with('success', 'Gallery images uploaded successfully.');
    }

    public function editgallery($id)
    {
        $gallery = Gallery::latest()->get();
        $editItem = Gallery::findOrFail($id);

        return view('course.gallery', compact('gallery', 'editItem'));
    }

    public function updategallery(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);

        $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $item->image = $path;
        }

        $item->description = $request->description;
        $item->save();

        return redirect()->back()->with('success', 'Gallery updated successfully.');
    }

    public function deletegallery($id)
    {
        $item = Gallery::findOrFail($id);

        if (Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

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

    public function deleteCategory($id)
    {
        $categories = Category::findOrFail($id);

        // Optional safety: prevent delete if courses exist
        if ($categories->courses()->count() > 0) {
            return back()->with('error', 'Cannot delete category with courses');
        }

        $categories->delete();

        return back()->with('success', 'Category Deleted Successfully');
    }

    public function storecourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',

            // NEW FIELDS
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048'
        ]);

        $brochurePath = null;

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,

            // NEW FIELDS
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $brochurePath,
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
            'brochure' => 'nullable|mimes:pdf|max:2048'
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
        ]);

        return back()->with('success', 'Course Updated Successfully');
    }

    public function coursedelete(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'brochure' => 'nullable|mimes:pdf|max:2048'
        ]);

        $course = Course::findOrFail($id);

        $brochurePath = $course->brochure;

        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'discount' => $request->discount ?? 0,
            'brochure' => $brochurePath,
        ]);

        return back()->with('success', 'Course Updated Successfully');
    }

    // DELETE COURSE
    public function deletecourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return back()->with('success', 'Course Deleted Successfully');
    }
}
