<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function upload_image(Request $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $name = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $name);

            return response()->json([
                'status' => true,
                'file' => $name
            ]);
        }

        return response()->json(['status'=>false]);
    }
}
