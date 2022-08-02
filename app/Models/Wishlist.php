<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
    ];

    public function scopeWhereArray($query, $array) {
        foreach ($array as $field =>$value) {
            $query -> where($field, $value);
        }
        return $query;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}