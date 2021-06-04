<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Brand extends BaseModel
{
    use HasFactory, HasTranslations;
    protected $table        = 'brands';
    protected $fillable     = ['name', 'image', 'enabled'];
    protected $appends      = ['image_path', 'name_trans', 'created_date', 'deleted_date'];
    public $translatable    = ['name'];

    public function getImagePathAttribute()
    {
        return asset('images/brands/' . $this->image);
    }
}
