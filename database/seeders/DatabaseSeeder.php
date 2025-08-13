<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Purchase;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
        ]);

        // User::factory(10)->create();

        $items = \App\Models\Item::all();

        Customer::factory(1000)->create();
        Purchase::factory(100)->create()->each(function(Purchase $purchase) use ($items){
            $purchase->items()->attach(
                $items->random(rand(1, 10))->pluck('id')->toArray(),
                ['quantity' => rand(1, 5)]
            );
        });


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
