<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title',
        'description'
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->code = "SUB-" . $model->id;
            $model->save();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id')
            ->withPivot('status');
    }
}
