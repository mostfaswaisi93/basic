<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends BaseModel
{
    use HasFactory;

    protected $table        = 'contacts';
    protected $fillable = [
        'address',
        'email',
        'phone',
    ];
    // protected $guarded      = [];
}
