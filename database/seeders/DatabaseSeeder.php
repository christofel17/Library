<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Author::create([
            'name' => 'Dr. Seuss',
            'slug' => 'dr.-seuss'
        ]);
        
        Author::create([
            'name' => 'Shel Silverstein',
            'slug' => 'shel-silverstein'
        ]);

        Book::factory(6)->create();
        
        /*
        Book::create([
            'title' => 'Green Eggs and Ham',
            'slug' => 'green-eggs-and-ham',
            'author_id' => 1,
            'publisher' => 'Random House',
            'year' => '1960'
        ]);
        
        Book::create([
            'title' => 'The Giving Tree',
            'slug' => 'the-giving-tree',
            'author_id' => 2,
            'publisher' => 'Harper & Row',
            'year' => '1964'
        ]);
        
        Book::create([
            'title' => 'Lafcadio, The Lion Who Shot Back',
            'slug' => 'lafcadio,-the-lion-who-shot-back',
            'author_id' => 2,
            'publisher' => 'Harper & Row',
            'year' => '1963'
        ]);
        
        Book::create([
            'title' => 'The Cat in The Hat',
            'slug' => 'the-cat-in-the-hat',
            'author_id' => 1,
            'publisher' => 'Random House',
            'year' => '1963'
        ]);
        */
        
    }
}
