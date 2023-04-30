<?php

namespace App\Http\Traits;

use App\Models\Client;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

trait UploadClientPhoto
{
    function saveClientImg($photo, $folder)
    {
        $file_extension =
            $photo->getClientOriginalExtension();
        $file_name = Client::all()->count() + 1 . '_profile_picture' . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
