<?php

namespace App\Models;



class Book
{
    private  static $books = [
        [
            "title" => "The Giving Tree",
            "slug" => "buku-pertama",
            "author" => "Shel Silverstein",
            "year" => "1964"
        ],
        [
            "title" => "Green Eggs and Ham",
            "slug" => "buku-kedua",
            "author" => "Dr. Seuss",
            "year" => "1960"
        ]
    ];

    public static function all(){
        // mengubah array biasa menjadi collection
        return collect(self::$books);
    }

    public static function find($slug){

        // $booko = self::$books;
        $booko = static::all();

        /*
        $book = [];
        foreach($booko as $b){
            if($b["slug"] === $slug){
                $book = $b;
            }
        }
        */

        // cari buku pertama dimana 'slugnya; sama dengan $slug
        return $booko->firstWhere('slug', $slug);
    }
}
