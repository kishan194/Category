<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = [
        'fullname',
        'email',
        'address',
        'city',
        'zip',
        'card_name',
        'credit_card_number',
        'exp_month',
        'exp_year',
        'cvv',

       
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
