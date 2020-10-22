<?php

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
        factory(App\Post::class, 18)->create();//esto hace referencia a que vamos a utilizar el factory de Post
        //18 es la cantidad de post q se van a registrar en la db
    }
}
