<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller {
    public function upload(Request $request) {
        // Doğrulama
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|max:5120', // 5MB limit
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            // Dosyayı kaydet
            $path = $request->file('photo')->store('skin-photos', 'public');

            return response()->json([
                'success' => true,
                'path' => $path,
                'url' => asset('storage/' . $path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dosya yükleme hatası: ' . $e->getMessage()
            ], 500);
        }
    }
}
