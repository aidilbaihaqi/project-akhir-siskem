<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = ['topic_id', 'author_id', 'reason'];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
