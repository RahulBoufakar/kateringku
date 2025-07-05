<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\menu;

// app/Models/OrderDetail.php
class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = []; // Izinkan mass assignment

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(menu::class);
    }
    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}