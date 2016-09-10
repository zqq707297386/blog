<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $primaryKey= 'about_id';
    public $timestamps   = false;
    protected $guarded   = [];
}
