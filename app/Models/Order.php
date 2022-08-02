<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'total'
    ];

    public function scopeWhereArray($query, $array)
    {
        foreach ($array as $field => $value) {
            $query->where($field, $value);
        }
        return $query;
    }
    protected $casts = [
        'product_id' => 'array',
        'status' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
