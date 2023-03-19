<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Uuid
{
    protected $isLockedUuid = true;

    /**
     * Used by Eloquent to get primary key type.
     * UUID Identified as a string.
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Used by Eloquent to get if the primary key is auto increment value.
     * UUID is not.
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }
    protected static function bootUuid()
    {
        // Create a UUID to the model if it does not have one
        static::creating(function (Model $model) {
            $model->keyType = 'string';
            $model->incrementing = false;

            if (!$model->getKey()) {
                $model->uuid = (string)Str::uuid();
            }
        });

        // Set original if someone try to change UUID on update/save existing model
        static::saving(function (Model $model) {
            $original_id = $model->getOriginal('uuid');
            if (!is_null($original_id) && $model->isLockedUuid) {
                if ($original_id !== $model->uuid) {
                    $model->uuid = $original_id;
                }
            }
        });
    }
}
