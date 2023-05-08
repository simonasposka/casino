<?php

namespace App\Models;

use App\Enums\ListingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $listing_id
 * @property int $creator_id
 * @property int|null $participant_id
 * @property int|null $winner_id
 * @property int $value
 * @property int $bet_on_outcome
 */
class Bet extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(ListingStatus::class);
    }
}
