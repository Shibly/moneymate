<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download($filename)
    {
        // Ensure the file path matches where the file is actually stored
        $filePath = "private/files/{$filename}";

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        return abort(404, 'File not found.');
    }
}
