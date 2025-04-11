<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'body'
    ];

    protected $casts = [
        'title' => 'encrypted',
        'body' => 'encrypted'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'id' => (string) $this->id,
            'user_id' => (string) $this->user_id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,
        ]);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, PostTag::class);
    }
}
