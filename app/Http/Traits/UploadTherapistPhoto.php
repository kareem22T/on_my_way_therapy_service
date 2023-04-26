<?php

namespace App\Http\Traits;

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

trait UploadTherapistPhoto
{
    function saveTherapistImg($photo, $folder)
    {
        $file_extension =
            $photo->getClientOriginalExtension();
        $file_name = Doctor::all()->count() + 1 . '_profile_picture' . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
