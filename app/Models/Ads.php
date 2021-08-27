<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    
    public $table = 'ads';
    public $primaryKey = 'ad_id';
    public $timestamps = true;

    protected $fillable = [
        'titre', 
        'description',
        'price',
        'id'
    ];

    public function adder()
    {
        return $this->hasMany(AdImage::class, 'ad_id', 'ad_id');
    }
}
