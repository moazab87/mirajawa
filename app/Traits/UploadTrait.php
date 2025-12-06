<?php

namespace App\Traits;

use File;

trait UploadTrait
{

    public function uploadAllTyps($file, $directory, $withExtension = false)
    {
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0777, true, true);
        }

        $fileMimeType = $file->getClientmimeType();
        $imageCheck   = explode('/', $fileMimeType);

        if ($imageCheck[0] == 'image') {
            $allowedImagesMimeTypes = allowedImagesMimeTypes();

            if (!in_array($fileMimeType, $allowedImagesMimeTypes)){
                return 'default.png';
            }

            return $this->uploadeImage($file, $directory , $withExtension);
        }

        if (in_array($file->getClientOriginalExtension(), allowedMimeTypesVideo())) {
            return $this->uploadFile($file, $directory, $withExtension);
        }

        $allowedMimeTypes = ['application/pdf', 'application/msword', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/octet-stream'];
        if (!in_array($fileMimeType, $allowedMimeTypes)){
            return 'default.png';
        }

        return $this->uploadFile($file, $directory, $withExtension);
    }

    public function uploadFile($file, $directory, $withExtension = false)
    {

        $filename     = time() . rand(1000000, 9999999) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        $fileMimeType = $file->getClientmimeType();
        $imageCheck   = explode('/', $fileMimeType);

        if (in_array($imageCheck, allowedImagesMimeTypes())) {
            $extension = 'image';
        } elseif (in_array($fileMimeType, allowedMimeTypesPdf())) {
            $extension = 'pdf';
        } else {
            $extension = 'video';
        }

        if ($withExtension) {
            return [
                'name'      => $filename,
                'extension' => $extension,
            ];
        }

        return $filename;
    }

    public function uploadeImage($file, $directory, $withExtension = false)
    {
        $name       = time() . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $name);

        if ($withExtension) {
            return [
                'name'      => $name,
                'extension' => 'image',
            ];
        }

        return (string)$name;
    }

    public function deleteFile($file_name, $directory = 'unknown'): void
    {
        if ($file_name && $file_name != 'default.png' && file_exists("$directory/$file_name")) {
            unlink("$directory/$file_name");
        }
    }

    public function defaultImage($directory)
    {
        return asset("$directory/default.png");
    }

    public static function getImage($name, $directory)
    {
        return asset("uploads/$directory/" . $name);
    }

    public static function getFile($name, $directory)
    {

        $types = ['default.png', 'default.mp4', 'default.pdf'];

        if (in_array($name, $types)) {
            return asset("defaults/$directory/" . $name);
        }
        return asset("$directory/" . $name);
    }
}
