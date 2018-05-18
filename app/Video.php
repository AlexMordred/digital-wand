<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $fillable = [
        'user_id',
        'file_path',
        'original_filename',
    ];

    protected $casts = [
        'reviewed' => 'boolean',
        'sent' => 'boolean',
    ];

    protected $appends = [
        'download_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (Storage::disk('public')->exists($model->file_path)) {
                Storage::disk('public')->delete($model->file_path);
            }
        });
    }

    public function getDownloadUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
