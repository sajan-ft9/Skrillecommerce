<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Sajan Khadka',
            'email' => 'sajan@gmail.com',
        ]);

        // Product factory

        \App\Models\Product::factory()->create([
            'name' => 'HP Victus',
            'description' => 'HP ryzen 5 Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure eum vitae omnis voluptates iste quae facere officiis ullam sed! Sed nesciunt accusamus amet unde aliquam excepturi minus, est deleniti. Adipisci.',
            'price' => 80000,
            'category' => 'HP',
            'quantity' => 10,
            'image' => '/storage/images/1683962133.jpg'
        ]);

        \App\Models\Product::factory()->create([
            'name' => 'Ideapad',
            'description' => 'Lenovo Ideapad Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure eum vitae omnis voluptates iste quae facere officiis ullam sed! Sed nesciunt accusamus amet unde aliquam excepturi minus, est deleniti. Adipisci.',
            'price' => 60000,
            'category' => 'Lenovo',
            'quantity' => 4,
            'image' => '/storage/images/1683961906.jpg'
        ]);
        \App\Models\Product::factory()->create([
            'name' => 'Dell',
            'description' => 'DELL Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure eum vitae omnis voluptates iste quae facere officiis ullam sed! Sed nesciunt accusamus amet unde aliquam excepturi minus, est deleniti. Adipisci.',
            'price' => 110000,
            'category' => 'HP',
            'quantity' => 3,
            'image' => '/storage/images/1683961704.jpg'
        ]);
    }
}
