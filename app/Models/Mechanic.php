<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname'
    ];

    public function mechanicTrucks(): HasMany
    {
        return $this->hasMany(Truck::class, 'mechanic_id', 'id');
    }
}
