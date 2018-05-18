<?php

use App\Book;
use App\Category;
use App\Publisher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('book_category')->delete();
        DB::table('books')->delete();
        DB::table('categories')->delete();
        DB::table('publishers')->delete();

        $parentCategories = factory(Category::class, 20)->create();

        DB::transaction(function() {
            $startPublishers = microtime(true);
            $publishers = factory(Publisher::class, 200)->create();
            info('Publishers created', [
                'time' => microtime(true) - $startPublishers,
            ]);
            $start = microtime(true);
            foreach($publishers as $p) {
                factory(Book::class, 200)->create([
                    'publisher_id' => $p->id,
                ]);
            }
            info('books created', [
                'time' => microtime(true) - $start,
            ]);
        });

        foreach($parentCategories as $parent) {
            factory(Category::class, 20)->create([
                'parent_id' => $parent->id,
            ]);
        }


        DB::transaction(function() {
            $start = microtime(true);
            $childCategories = Category::childCategories()->get(['id'])->pluck('id');
            $books = Book::all(['id']);
            foreach($books as $b) {
                $b->categories()->sync($childCategories->random(2));
            }
            info('completed attaching categories', [
                'time' => microtime(true) - $start
            ]);
        });

    }
}
