<?php

use Intervention\Image\Facades\Image;

if (!function_exists('getImage')) {
    function getImage($image)
    {
        if (fileStorage_exit($image)) {
            $img = Image::make(storage_path($image));
            return $img->encode('data-url');
        } else {
            return noImage();
        }
    }
}

if (!function_exists('fileStorage_exit')) {
    function fileStorage_exit($image)
    {
        if (file_exists(storage_path($image)) && !empty($image)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('noImage')) {
    function noImage()
    {
        return asset('images/backOffice/banner/banner-no-img.png');
    }
}

if (!function_exists('getImageName')) {
    function getImageName($image)
    {
        if (!empty($image)) {
            $arr = explode('/', $image);
            return $arr[count($arr) - 1];
        } else {
            return '';
        }
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($image, $topath = 'images', $thumbSize = 600)
    {
        if (!empty($image)) {
            $file_name = md5(time()) . '.' . $image->getClientOriginalExtension();
            $destination_path = storage_path($topath);

            if ($image->move($destination_path, $file_name)) {
                $response = [
                    'name' => $file_name,
                    'path' => $topath,
                    'full' => $topath . '/' . $file_name
                ];

                $img = Image::make(storage_path($response['full']));
                $img->resize($thumbSize, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                if (!is_dir(storage_path($topath . '/thumb'))) {
                    mkdir(storage_path($topath . '/thumb'), 0755, true);
                }

                $img->save(storage_path($topath . '/thumb/_thmb' . $file_name), 60);

                return $response;
            }
            return false;
        } else {
            return false;
        }
    }
}

if (!function_exists('getLang')) {
    function getLang()
    {
        if (\Session::has('language')) {
            return \Session::get('language');
        } else {
            return \App::getLocale();
        }
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
