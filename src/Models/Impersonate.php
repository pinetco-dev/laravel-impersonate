<?php

namespace Pinetcodev\LaravelImpersonate\Models;

use Illuminate\Database\Eloquent\Model;

class Impersonate extends Model
{
    public $guarded = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
