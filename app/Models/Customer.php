<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{


    protected $fillable = [
        'fullname',
        'phone',
        'email',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'user_id');
    // }

 

    use HasFactory;
}
