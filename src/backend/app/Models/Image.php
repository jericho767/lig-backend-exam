<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'images';
    protected $fillable = [
        'url',
        'imageable_type',
        'imageable_id',
    ];

    /**
     * Relationship method to get the model to which the image belongs.
     *
     * @return MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
    }
}
