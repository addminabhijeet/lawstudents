<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CourseNote extends Model
{
    /**
     * Paid note PDFs live on the private disk so they can only be reached
     * through the access-checked controllers, never by a direct URL.
     */
    public const DISK = 'local';

    /**
     * Uploads made before the move to the private disk may still sit on the
     * public disk until `php artisan notes:move-to-private` has been run.
     */
    private const LEGACY_DISK = 'public';

    protected $fillable = [
        'course_id',
        'subject_id',
        'title',
        'description',
        'file_path',
        'file_size',
        'page_count',
        'is_downloadable',
        'status',
        'download_count',
        'version',
        'visibility',
        'delete',
    ];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Additive relation — a note optionally belongs to a Subject (its
    // "Chapter" grouping per the doc's Course Page Structure). Notes with no
    // subject_id (every note that existed before this column) keep working
    // exactly as before wherever course()/notes() are already used.
    public function subject()
    {
        return $this->belongsTo(CourseSubject::class, 'subject_id');
    }

    // Accessor for readable size
    public function getFormattedSizeAttribute()
    {
        if (!$this->file_size) return '0 KB';

        $size = $this->file_size;

        if ($size >= 1048576) {
            return round($size / 1048576, 2) . ' MB';
        }

        return round($size / 1024, 2) . ' KB';
    }

    public function wishlists()
    {
        return $this->hasMany(NoteWishlist::class, 'note_id');
    }

    /**
     * Absolute path of the note's PDF, or null when the file is missing.
     */
    public function absolutePath(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        foreach ([self::DISK, self::LEGACY_DISK] as $disk) {
            if (Storage::disk($disk)->exists($this->file_path)) {
                return Storage::disk($disk)->path($this->file_path);
            }
        }

        return null;
    }

    public function deleteFile(): void
    {
        if (!$this->file_path) {
            return;
        }

        foreach ([self::DISK, self::LEGACY_DISK] as $disk) {
            Storage::disk($disk)->delete($this->file_path);
        }
    }
}
