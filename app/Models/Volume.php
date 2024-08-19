<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book(){
        // belongsTo untuk relationship one to many kebalikan has many
        return $this->belongsTo(Book::class);
    }

    public function borrow(){
        return $this->hasMany(Borrow::class);
    }
}
