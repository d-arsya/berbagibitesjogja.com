<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $guarded = [];
    public function messages(){
        return $this->hasMany(Message::class,'target','id')->get();
    }
}
