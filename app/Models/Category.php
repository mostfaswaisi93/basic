<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'categories';
    protected $fillable     = ['category_name', 'user_id', 'enabled'];
    protected $appends      = ['name_trans'];
    public $translatable    = ['name'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
