<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Julio Daniel',
            'email'=> 'julio@stetamalo.com',
            'password' => bcrypt('julio12345'),

        ]);

        factory(Post::class,24)->create();
    }

    
}
