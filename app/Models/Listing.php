<?php

namespace App\Models;

use App\Enums\ListingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $event_id
 * @property string $outcome_label_one
 * @property string outcome_label_two
 * @property ListingStatus $status
 * @property int|null $category_id
 * @method Builder where(string $field, string $condition, string $value)
 * @method static find(int $listingId)
 */
class Listing extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function createNewListing(
        string $first_label,
        string $second_label,
        int $event_id,
        ?int $categoryId = null,
    ): Listing {
        $listing = new Listing();

        $listing->event_id = $event_id;
        $listing->category_id = $categoryId;
        $listing->outcome_label_one = $first_label;
        $listing->outcome_label_two = $second_label;
        $listing->save();
        return $listing;
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class);
    }
}
