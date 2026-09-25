<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\MailSetting;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Extracted from CourseController. Handles admin settings: profile, banner, mail config.
 */
class AdminSettingsController extends Controller
{
    // ========== Admin Profile Details ==========

    public function admindetails()
    {
        $admin = User::first();
        return view('course.admin', compact('admin'));
    }

    public function updatedetails(Request $request, $id)
    {
        $gallery = User::findOrFail($id);

        $request->validate([
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'accsign'     => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'diraccsign'  => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'name'        => 'nullable|string|max:255',
            'mobile'      => 'nullable|string|max:30',
            'webemail'    => 'nullable|email|max:255',
            'webaddress'  => 'nullable|string|max:500',
            'linkedin'    => 'nullable|string|max:500',
            'facebook'    => 'nullable|string|max:500',
            'instagram'   => 'nullable|string|max:500',
            'pinterest'   => 'nullable|string|max:500',
            'twitter'     => 'nullable|string|max:500',
            'youtube'     => 'nullable|string|max:500',
            'defaultpass' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'centerone'   => 'nullable|string',
            'centertwo'   => 'nullable|string',
            'terms'       => 'nullable|string',
        ]);

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
            'youtube' => $request->youtube,
            'defaultpass' => $request->defaultpass,
            'centerone' => $request->centerone,
            'centertwo' => $request->centertwo,
            'terms' => $request->terms,
        ]);

        return back()->with('success', 'Admin updated successfully');
    }

    // ========== Banner Management ==========

    public function listbanner()
    {
        $banner = Banner::first();
        return view('course.banner', compact('banner'));
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
        return back()->with('success', 'Banner images updated successfully.');
    }

    // ========== Mail Settings ==========

    public function mailsetting()
    {
        $mailsetting = MailSetting::first();
        return view('course.mailsetting', compact('mailsetting'));
    }

    public function updatemailsetting(Request $request, $id)
    {
        $data = $request->validate([
            'mail_host'         => 'required|string',
            'mail_port'         => 'required|numeric',
            'mail_username'     => 'required|string',
            'mail_password'     => 'required|string',
            'mail_encryption'   => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name'    => 'required|string',
        ]);

        MailSetting::updateOrCreate(['id' => $id], $data);

        return back()->with('success', 'Mail settings updated successfully');
    }
}
