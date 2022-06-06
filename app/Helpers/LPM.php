<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class LPM
{
    public static function UploadImage($input_name, $sub_directory = null)
    {
        if (request()->hasFile($input_name)) {
            # main environtment
            $file = request()->file($input_name);
            $filename = date('YmdHi') . self::randomString(10) . '.' . $file->getClientOriginalExtension();
            $path = 'image' . ($sub_directory != '' ? '/' . $sub_directory : '');

            # upload image
            $file->move(public_path($path), $filename);

            return $path . '/' . $filename;
        }

        return null;
    }

    public static function UploadBase64($input_name, $sub_directory = null)
    {
        # get value
        $image = request($input_name);
        if ($image != '') {
            # main environtment
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $filename = date('YmdHi') . self::randomString(10) . '.' . 'png';
            $path = 'image' . ($sub_directory != '' ? '/' . $sub_directory : '');

            # create directory if not exists
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            # upload image
            File::put(public_path($path . '/' . $filename), base64_decode($image));

            return $path . '/' . $filename;
        }

        return null;
    }

    public static function randomString($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public static function now()
    {
        return date('Y-m-d H:i:s');
    }
}
