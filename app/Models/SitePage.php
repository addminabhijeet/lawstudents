<?php

namespace App\Models;

use App\Helpers\RichTextSanitizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title', 'content', 'last_updated'];

    protected $casts = [
        'last_updated' => 'datetime',
    ];

    /**
     * Content is rendered unescaped on the public page, so clean it on save.
     */
    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = RichTextSanitizer::clean($value);
    }

    /**
     * Get page by slug
     */
    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
