<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first-name',
        'last-name',
        'description',
        'email',
        'position',
        'departments_id',

       
    ];
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function project(){
        return $this->belongsToMany(project::class,'project_employee');
    }
    public function notes() {
        return $this->morphMany(Note::class,'noteable');
    }

}