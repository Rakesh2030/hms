<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // This model stores the common website settings like site name, logo and footer text.
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'footer_text',
    ];
}
