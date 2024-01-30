<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Author;
use Faker\Factory;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # https://fakerphp.github.io
        $this->faker = Factory::create();

        # Array of author data to add
        $authors = [
            ['F. Scott', 'Fitzgerald', 1896, 'https://en.wikipedia.org/wiki/F._Scott_Fitzgerald'],
            ['Sylvia', 'Plath', 1932, 'https://en.wikipedia.org/wiki/Sylvia_Plath'],
            ['Maya', 'Angelou', 1928, 'https://en.wikipedia.org/wiki/Maya_Angelou'],
            ['J.K.', 'Rowling', 1965, 'https://en.wikipedia.org/wiki/J._K._Rowling'],
            ['Anthony', 'Weir', 1972, 'https://en.wikipedia.org/wiki/Andy_Weir'],
            ['Amy', 'Tan', 1952, 'https://en.wikipedia.org/wiki/Amy_Tan'],
        ];

        $count = count($authors);

        # Loop through each author, adding them to the database
        foreach ($authors as $authorData) {
            $author = new Author();
        
            $author->created_at = $this->faker->dateTimeThisMonth();
            $author->updated_at = $this->faker->dateTimeThisMonth();
            $author->first_name = $authorData[0];
            $author->last_name = $authorData[1];
            $author->birth_year = $authorData[2];
            $author->bio_url = $authorData[3];
        
            $author->save();
        
            $count--;
        }
    }
}
