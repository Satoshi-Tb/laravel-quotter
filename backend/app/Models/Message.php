<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\Quser|null $quser
 */
class Message extends Model
{
    public function quser(): BelongsTo
    {
        return $this->belongsTo(Quser::class, 'mentioned_user_id');
    }

    public function getDisplayName(): ?string
    {
        return $this->quser?->display_name;
    }
}
