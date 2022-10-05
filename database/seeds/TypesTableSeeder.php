<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Italiano', 'Cinese', 'Giapponese', 'Messicano', 'Indiano', 'Fast Food', 'Pizza', 'Hamburger', 'Kebab'];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Str::of($newType->name)->slug('-');
            $newType->save();
        }        
    }
}