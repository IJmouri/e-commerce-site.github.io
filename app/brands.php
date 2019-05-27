<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    protected $fillable = ['brand_name','brand_description','publication_status'];
}
