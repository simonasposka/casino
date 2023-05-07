<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $bet_id
 * @property string $name
 * @property string|null $description
 * @property int|null $value
 * @method static Builder where(string $field, string $comparison, string $value)
 * @method static find(mixed $itemId)
 */
class Item extends Model
{
    use HasFactory;

    public $timestamps = false;
}
