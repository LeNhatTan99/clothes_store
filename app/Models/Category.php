<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    const VIEWABLE = [
        'ao-so-mi'=> 'shirt',
        'dam'=> 'dress',
        'quan-dai'=> 'trousers',
        'ao-thun'=> 'tshirt',
        'ao-khoac'=> 'coat',
        'quan-short'=> 'short',
        'chan-vay'=> 'skirt',
    ];

    // relation
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
