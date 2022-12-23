<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
