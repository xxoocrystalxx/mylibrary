<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $genres = [
            [
                'name' => 'Fantasy',
            ],
            [
                'name' => 'Adventure',
            ],
            [
                'name' => 'Fiction',
            ],
            [
                'name' => 'Poetry',
            ],
            [
                'name' => 'Literature',
            ],
            [
                'name' => 'Classics',
            ],
        ];

        $authors = [
            [
                'name' => 'J.K. Rowling',
                'born' => '1965/07/31',
            ],
            [
                'name' => 'Dante Alighieri',
                'born' => '1265/04/09',
            ]
        ];

        $books = [
            [
                'author_id' => '1',
                'title' => "Harry Potter and the Philosopher's Stone",
                'description' => 'Harry Potter thinks he is an ordinary boy - until he is rescued by an owl, taken to Hogwarts School of Witchcraft and Wizardry, learns to play Quidditch and does battle in a deadly duel. The Reason ... HARRY POTTER IS A WIZARD!',
                'date_publish' => '1997/06/26',
                'image' => 'upload/book/1755927378708092.jpg'

            ],
            [
                'author_id' => '2',
                'title' => 'The Divine Comedy',
                'description' => "The Divine Comedy describes Dante's descent into Hell with Virgil as his guide; his ascent of Mount Purgatory and reunion with his dead love, Beatrice; and, finally, his arrival in Heaven.",
                'date_publish' => '1320/01/01',
                'image' => 'upload/book/1740692754495456.jpg'
            ]
        ];

        foreach ($genres as $item) {
            Genre::create($item);
        }
        foreach ($authors as $item) {
            Author::create($item);
        }

        $book1 = Book::create($books[0]);
        $book1->genres()->attach([1, 2, 3]);
        $book1 = Book::create($books[1]);
        $book1->genres()->attach([4, 5, 6]);
    }
}
