<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

/**
 * @property string $uuid
 * @property Date $date_of_event
 * @property string $name
 * @property string $location
 * @property array $config
 * @method Builder where(string $field, string $condition, string $value)
 */
class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function createNewBasketballGameEvent(array $eventFromApi): Event
    {
        $event = new Event();
        $event->uuid = $eventFromApi['uuid'];
        $event->date_of_event = Date('Y-m-d h:i:s',$eventFromApi['date_of_event']);
        $event->name = $eventFromApi['name'];
        $event->location = $eventFromApi['location'];
        $event->config = json_encode([
            'teams' => $eventFromApi['teams']
        ]);
        $event->save();

        return $event;
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
