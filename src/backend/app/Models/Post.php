<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
    ];

    /**
     * Relationship method for the poster of the post.
     *
     * @return BelongsTo
     */
    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
