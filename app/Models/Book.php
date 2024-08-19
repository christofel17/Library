<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    // untuk memperbolehkan mass assignment

    // protected $fillable = ['title','author','publisher', 'year'];
    protected $guarded = ['id'];

    // eager loading dipindah dari controller
    protected $with =['author'];
    
    public function author(){
        // belongsTo untuk relationship one to many kebalikan has many
        return $this->belongsTo(Author::class);
    }

    public function volume(){
        return $this->hasMany(Volume::class);
    }
}
