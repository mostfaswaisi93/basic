<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Multipic extends BaseModel
{
    use HasFactory;
    protected $table        = 'multipics';
    protected $fillable     = ['image', 'enabled'];
    protected $appends      = ['image_path', 'created_date', 'deleted_date'];

    public function getImagePathAttribute()
    {
        return asset('images/multipics/' . $this->image);
    }
}
