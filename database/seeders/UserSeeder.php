<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('admin');

        $user = new User();
        $user->name = "johnny vasco calle";
        $user->email = "jvasco@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('user');

        $user = new User();
        $user->name = "alfredo balderas zeballos";
        $user->email = "abalderas@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('user');

        $user = new User();
        $user->name = "adriana gamboa limachi";
        $user->email = "agamboa@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('user');
    }
}
