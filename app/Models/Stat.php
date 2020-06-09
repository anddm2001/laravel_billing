<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $timestamps = false;

    protected $fillable = ['status'];

	protected $table = 'metrics';

	protected $primaryKey = 'id';

	public $incrementing = true;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

}
