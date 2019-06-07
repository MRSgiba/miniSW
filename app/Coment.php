<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    protected $fillable = [
        'user_id', 'commentauthor_id', 'text',
    ];
    
    public function commentauthor()
    {
        return $this->belongsTo('App\User');
    }

}
