<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('123456789');
        $user->role = 2;
        $user->save();
    }
}
