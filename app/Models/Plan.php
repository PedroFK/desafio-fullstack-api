<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'clients_count',
        'gigabytes_storage',
        'price',
        'active',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
