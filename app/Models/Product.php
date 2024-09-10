<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'phone_name',
        'display_size',
        'quantity',
        'cost',
    ];

    public function sellers()
    {
        return $this->belongsToMany(Seller::class);
    }
}
