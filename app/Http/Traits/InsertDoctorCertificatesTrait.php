<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait InsertDoctorCertificatesTrait
{
    function saveImg($photo, $folder, $certificate_name)
    {
        $file_extension =
            $photo->getClientOriginalExtension();
        $file_name = Auth::guard('doctor')->user()->id . '_' . $certificate_name . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }
}