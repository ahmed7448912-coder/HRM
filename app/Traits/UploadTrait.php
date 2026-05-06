<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadFile($file, $path = 'uploads')
    {
        if (!$file) return null;

        $fileName = time() . '_' . $file->getClientOriginalName();

        return $file->storeAs($path, $fileName, 'public');
    }

    public function deleteFile($filePath)
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
