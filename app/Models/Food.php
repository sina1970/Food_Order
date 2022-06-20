<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $primaryKey = 'id';
    protected $fillable = ['name','amount','cook_time','price','category_id'];

    public function categories():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
