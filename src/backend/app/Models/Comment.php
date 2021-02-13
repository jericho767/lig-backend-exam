<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comments';
    protected $fillable = [
        'body',
        'commentable_type',
        'commentable_id',
        'creator_id',
        'parent_id',
    ];

    /**
     * Relationship method for the creator of the comment.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Relationship method for the identification of the model of the ID.
     *
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'commentable_type', 'commentable_id');
    }
}
