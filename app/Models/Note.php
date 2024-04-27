<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'note',
    ];

    public function noteable(){
        return $this->morphTo();
    }
}
