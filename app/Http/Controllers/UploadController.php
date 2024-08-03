<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function storeMultipleFile(Request $request)
    {
        if ($request->hasFile('file')) {
            return $this->handleUpload($request->file('file'));
        }
        return null;
    }

    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $url = $this->handleUpload($request->file('upload'));
            $url = asset($url);
            $msg = 'Tải lên thành công';
            // $CKEditorFuncNum = $request->input('CKEditorFuncNum')??'upload';
            // $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // @header('Content-type: text/html; charset=utf-8');
            // echo $response;
            return response()->json(['fileName' => 'upload', 'url' => $url, 'uploaded' => 1]);
        }
    }

    public function handleUpload($image){
        $fileExtension = $image->extension();
        $imageName = Str::uuid()->toString().'.'.$fileExtension;
        $image -> move(public_path('storage/'.date('d_m_y').'/image/'), $imageName);
        $path = 'storage/'.date('d_m_y').'/image/'.$imageName;

        return $path;

        return $this->toWebp($path, $fileExtension, true);
    }

    function toWebp($path, $fileExtension, $isResize) {
        // Save the image
        $webPImage = imagecreatefromstring(file_get_contents($path));
        $baseName = basename($path, '.'.$fileExtension);
        $dirname = pathinfo($path, PATHINFO_DIRNAME);
        $finalName = $dirname . "/" . $baseName . ".webp";
        imagewebp($webPImage, $finalName, 40);
        //Xóa ảnh cũ
        unlink($path);
        return $finalName;
    }
}
