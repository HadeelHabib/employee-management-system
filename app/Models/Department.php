<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
       
        
    ];

    public function employee(){
        return $this->hasMany(Employee::class);
    }
    public function notes() {
        return $this->morphMany(Note::class,'noteable');
    }
}