<?php

use App\Models\Settings;
use Carbon\Carbon;


if (!function_exists('allowedImagesMimeTypes')) {
    function allowedImagesMimeTypes()
    {
        return [
            'image/gif',
            'image/jpeg',
            'image/png',
            'image/swf',
            'image/psd',
            'image/bmp',
            'image/tiff',
            'image/tiff',
            'image/jpc',
            'image/jp2',
            'image/jpf',
            'image/jb2',
            'image/swc',
            'image/aiff',
            'image/wbmp',
            'image/xbm',
            'image/webp',
            'application/octet-stream'
        ];
    }
}

if (!function_exists('allowedMimeTypesVideo')) {
    function allowedMimeTypesVideo()
    {
        return [
            'mp4',
            'avi',
            'mov',
            'wmv'
        ];
    }
}

if (!function_exists('allowedMimeTypesPdf')) {
    function allowedMimeTypesPdf()
    {
        return  [
            'application/pdf',
        ];
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($image)
    {
        if (\File::exists($image)) {
            unlink($image);
        }
    }
}

if (!function_exists('generateRandomCode')) {
    function generateRandomCode()
    {
        return '1234';
        return rand(1111, 4444);
    }
}

if (!function_exists('languages')) {
    function languages()
    {
        return ['ja', 'en'];
    }
}

if (!function_exists('defaultLang')) {
    function defaultLang()
    {
        return app()->getLocale() == 'en' ? 'ja' : 'en';
    }
}

if (!function_exists('numFormat')) {
    function numFormat($number): string
    {
        return number_format($number, 2, '.', '');
    }
}

if (!function_exists('mimesImage')) {
    function mimesImage()
    {
        $extension = [
            'gif',
            'jpeg',
            'png',
            'swf',
            'psd',
            'bmp',
            'tiff',
            'tiff',
            'jpc',
            'jp2',
            'jpf',
            'jb2',
            'swc',
            'aiff',
            'wbmp',
            'xbm',
            'webp'
        ];

        return implode(',', $extension);
    }
}

if (!function_exists('convert2english')) {
    function convert2english($string)
    {
        $newNumbers = range(0, 9);
        $arabic     = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $string     = str_replace($arabic, $newNumbers, $string);
        return $string;
    }
}

if (!function_exists('fixPhone')) {
    function fixPhone($string = null)
    {
        if (!$string) {
            return null;
        }

        $result = convert2english($string);
        $result = ltrim($result, '00');
        $result = ltrim($result, '0');
        $result = ltrim($result, '+');
        return $result;
    }
}

if (!function_exists('fixKey')) {
    function fixKey($string = null)
    {
        if (!$string) {
            return null;
        }

        $result = convert2english($string);
        $result = ltrim($result, '00');
        $result = ltrim($result, '0');
        $result = ltrim($result, '+');
        return '+' . $result;
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($path, $request_file)
    {
        $fileName = time() . '.' . $request_file->getClientOriginalExtension();
        $request_file->move(public_path('uploads/' . $path), $fileName);
        return $fileName;
    }
}
if (!function_exists('getSettingImageLink')) {
    function getSettingImageLink($key, $lang = false, $default = null)
    {
        if ($lang) {
            $key = $key . '_' . app()->getLocale();
        }
        $setting = Settings::where('key', $key)->first();
        if ($setting != '' && $setting['value'] != '') {
            $imagePath = 'uploads/settings/' . $setting['value'];

            if (file_exists(public_path($imagePath))) {
                $link = asset($imagePath);
            } else {
                $link = $default ? asset($default) : '';
            }
        } else {
            $link = $default ? asset($default) : '';
        }
        return $link;
    }
}

if (!function_exists('getSettingValue')) {
    function getSettingValue($key)
    {
        $value = '';
        $setting = Settings::where('key', $key)->first();
        if ($setting != '') {
            $value = $setting['value'];
        }
        return $value;
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($path, $image)
    {
        $imageName  = \Str::random(45) . '.' . $image->extension();
        $image->move(public_path('uploads/' . $path), $imageName);
        return $imageName;
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($image)
    {
        if (File::exists($image)) {
            unlink($image);
        }
    }
}


if (!function_exists('logError')) {
    function logError($exception = null)
    {
        deleteLogFile();
        $trace = debug_backtrace();
        $class = $trace[1]['class'];
        $function = $trace[1]['function'];
        info('there is error at class ===> ' . $class . ' , function ===> ' . $function . ' //// the exception ===========> ', [
            'message' => $exception->getMessage(),
            'file' => [
                'file' => $exception?->getFile(),
                'line' => $exception?->getLine(),
            ],
        ]);
        return response()->json([
            'key' => 'fail',
            'msg' => __('apis.server_error'),
        ]);
    }
}

if (!function_exists('deleteLogFile')) {
    function deleteLogFile($max_size = 10)
    {
        $logFilePath = storage_path('logs/laravel.log');

        if (file_exists($logFilePath)) {
            $fileSize = filesize($logFilePath);

            $base = log($fileSize, 1024);
            $size = round(pow(1024, $base - floor($base)), 2);

            if ($size > $max_size) {
                unlink($logFilePath);
            }
        }
    }
}
