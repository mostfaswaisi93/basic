<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table        = 'settings';
    protected $fillable     = ['name', 'title', 'value', 'type', 'options', 'sorting_number', 'enabled'];

    // protected $fillable = [
    //     'sitename_ar',
    //     'sitename_en',
    //     'logo',
    //     'icon',
    //     'email',
    //     'description',
    //     'keywords',
    //     'status',
    //     'message_maintenance',
    //     'main_lang',
    // ];

    public function getOptionsAttribute()
    {
        $array = [];
        if ($this->attributes['options'] != null) {
            $array = explode(',', $this->attributes['options']);
        }
        return $array;
    }

    public function getrealValueAttribute()
    {
        $array = $this->options;
        return $array == [] ? $this->attributes['value'] : $array[$this->attributes['value']];
    }

    public function getTitleAttribute()
    {
        return trans('admin.', $this->attributes['title']);
    }
}
