<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table        = 'brands';
    protected $fillable     = ['name', 'image', 'enabled'];
    protected $appends      = ['image_path', 'name_trans', 'created_at_before'];
    public $translatable    = ['name'];

    public function getImagePathAttribute()
    {
        return asset('images/brands/' . $this->image);
    }
}
