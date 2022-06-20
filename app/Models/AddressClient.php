<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressClient extends Model
{
    use HasFactory;
    protected $table = 'address_client';
    protected $fillable = ['client_id','address_id'];
}
