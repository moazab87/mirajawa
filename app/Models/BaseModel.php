<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    use UploadTrait;

    const IMAGEPATH        = '';

    public function getFileAttribute()
    {
        return $this->getFile($this->attributes['file'], static::IMAGEPATH);
    }

    public function setFileAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['file']) ? $this->deleteFile($this->attributes['file'], static::IMAGEPATH) : '';

            $file                     = $this->uploadAllTyps($value, static::IMAGEPATH, true);
            $this->attributes['file'] = $file['name'];
            $this->attributes['type'] = $file['extension'];
        }
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {

            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], "uploads/" . static::IMAGEPATH): '';
            $file                       = $this->uploadAllTyps($value, "uploads/" . static::IMAGEPATH , true);
            $this->attributes['image']  = $file['name'];
        }
    }

    public function getImageAttribute($value)
    {
        return asset("uploads/" . static::IMAGEPATH . "/$value");
    }

    public static function boot()
    {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        static::creating(function ($model) {
            // if (!isset($model->attributes['code'])) {
            //     $model->code = rand(100000, 999999);
            // }

        });

        static::deleted(function ($model) {
            if (isset($model->attributes['image'])) {
                $model->deleteFile($model->attributes['image'], static::IMAGEPATH);
            }

            if (isset($model->attributes['file'])) {
                $model->deleteFile($model->attributes['file'], static::IMAGEPATH);
            }

            // if model has sizes then detach sizes from the product
            if (isset($model->sizes)) {
                $model->sizes()->detach();
            }
            // if model has productImages then detach productImages from the product
            if (isset($model->productImages)) {
                $model->productImages()->delete();
            }
        });
    }
}
