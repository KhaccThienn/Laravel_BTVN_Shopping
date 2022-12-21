<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'price', 'sale_price', 'image', 'status', 'description', 'category_id'];

    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
        
    }

    public function scopeSearch($query)
    {
        if (request()->keyword) {
            $keyword = request()->keyword;
            $query = $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
    }

    public function scopeFilter($query)
    {
        if (request()->order) {
            $order = request()->order;
            $order_arr = explode('-', $order);
            $query = $query->orderBy($order_arr[0], $order_arr[1]);
        }
        return $query;
    }
}
