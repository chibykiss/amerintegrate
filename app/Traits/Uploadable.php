<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

Trait Uploadable 
{
    public function UserImageUpload($image, $image_path, string $imgname = null)
    {
        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = "public/$image_path";    //Creating Sub directory in Public folder to put image
        $image_url = $image_full_name;
        $image->storeAs($upload_path, $image_full_name);
        $old_path = storage_path("app/public/$image_path/" . $imgname);
        if (File::exists($old_path)) {
            File::delete($old_path);
            //unlink(public_path($name));
        };
        return $image_url;
    }
}