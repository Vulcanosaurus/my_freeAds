<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRUDUser extends Model
{
    use HasFactory;
    
    public $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

}
