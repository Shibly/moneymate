<?php


namespace App\Http\Controllers;

class AttachmentController extends Controller
{
    public function download($filename)
    {
        // Correct file path to the 'private' folder inside 'storage/app'
        $filePath = storage_path("app/private/{$filename}");

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        // If the file doesn't exist, return a 404 error
        return abort(404, 'File not found.');
    }


    public function servePrivateFile($filename)
    {
        $path = storage_path('app/private/' . $filename);

        // Debugging: Check if path is correct.
        dd($path);

        if (file_exists($path)) {
            return response()->file($path, [
                'Content-Type' => mime_content_type($path),
                'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
            ]);
        }

        abort(404);
    }


}
