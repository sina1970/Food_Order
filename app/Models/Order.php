<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['client_id','price','address','phone','verify','cook_time'];

    public function foods(){
        return $this->belongsToMany(Food::class);
    }
}
