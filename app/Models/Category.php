<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'categories';
    protected $fillable     = ['name', 'user_id', 'enabled'];
    protected $appends      = ['name_trans', 'created_date', 'deleted_date'];
    public $translatable    = ['name'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
