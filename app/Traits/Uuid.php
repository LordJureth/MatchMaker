<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    protected static function boot()
    {
        parent::boot();

        /** 
         * If the Key is empty then set the UUID
         */
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->setAttribute($model->getKeyName(), str::uuid()->tostring());
            }
        });
    }

    /** 
     * Disable auto increment
     */
    public function getIncrementing()
    {
        return false;
    }

    /** 
     * Override default key data type. Needs to be String for UUID
     */
    public function getKeyType()
    {
        return 'string';
    }
}
