<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = ['product_name','product_price','product_quantity','short_description','long_description','product_Image','publication_status'];
}
