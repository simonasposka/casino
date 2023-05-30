<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public $timestamps = false;
    protected $table = 'wallet'; // Specify the correct table name here
    protected $fillable = [
        'user_id', 'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
