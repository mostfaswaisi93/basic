<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Service extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'services';
    protected $fillable     = ['name', 'price', 'enabled'];
    protected $appends      = ['name_trans'];
    public $translatable    = ['name'];
}
