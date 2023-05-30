<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $table = 'store';
    use HasFactory;

    public $timestamps = false;

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
