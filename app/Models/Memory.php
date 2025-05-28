<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'category_id',
        'is_favorite',
        'image_media_path',
        'audio_media_path',
        'video_media_path',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'date',
        'is_favorite' => 'boolean',
    ];

    /**
     * Get the category that owns the memory.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user that owns the memory.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_media_path) {
            return asset('storage/' . $this->image_media_path);
        }
        return null;
    }

    /**
     * Get the audio URL attribute.
     */
    public function getAudioUrlAttribute()
    {
        if ($this->audio_media_path) {
            return asset('storage/' . $this->audio_media_path);
        }
        return null;
    }

    /**
     * Get the video URL attribute.
     */
    public function getVideoUrlAttribute()
    {
        if ($this->video_media_path) {
            return asset('storage/' . $this->video_media_path);
        }
        return null;
    }
}
