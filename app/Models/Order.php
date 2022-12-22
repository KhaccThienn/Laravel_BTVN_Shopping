<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address', 'phone', 'status'];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->details as $item) {
            $total += $item->quantity * $item->price;
        }

        return $total;
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
