<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    use HasFactory;

    public $table = 'ad_images';
    public $timestamps = true;

    protected $fillable = [
        'image_path',
        'ad_id'
    ];

    public function ads()
    {
        return $this->belongsTo(Ads::class);
    }
}
