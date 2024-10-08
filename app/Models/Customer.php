<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{


    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'address',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'cus_id');
    }
 

    use HasFactory;
}
