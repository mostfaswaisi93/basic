<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    public $timestamps  = true;
    protected $casts    = ['created_at' => 'date:Y-m-d - H:i A', 'updated_at' => 'date:Y-m-d - H:i A'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    // Unicode DB to Arabic
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // get Name Translatable
    public function getNameTransAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    public function scopeActive($query)
    {
        return $query->where('enabled', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('enabled', 0);
    }

    public function getActiveAttribute()
    {
        return $this->active == 1 ? "{{ trans('admin.active') }}" : "{{ trans('admin.inactive') }}";
    }

    public function getCreatedAtBeforeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
