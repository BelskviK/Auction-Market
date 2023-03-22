<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lot extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'lots';
    protected $fillable = ['name', 'cogs', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
