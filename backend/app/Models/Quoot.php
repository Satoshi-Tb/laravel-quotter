<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Quser|null $quser
 */
class Quoot extends Model
{
    /** @use HasFactory<\Database\Factories\QuootFactory> */
    use HasFactory;

    public function quser(): BelongsTo
    {
        return $this->belongsTo(Quser::class, 'user_id');
    }

    public function getUserName(): ?string
    {
        return $this->quser?->user_name;
    }

    public function getDisplayName(): ?string
    {
        return $this->quser?->display_name;
    }

    public function getImagePath()
    {
        return $this->quser->getImagePath();
    }
}
