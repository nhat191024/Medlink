<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'disk',
        'path',
        'original_name',
        'mime_type',
        'size',
        'uploaded_by',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(): ?string
    {
        if (!$this->disk || !$this->path) return null;
        return Storage::disk($this->disk)->url($this->path);
    }
}
