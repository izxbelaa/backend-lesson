<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Matter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            Contact::factory()
                ->count(50)
                ->has(Matter::factory()->count(rand(0, 5)), 'matters')
                ->create();
        });
    }
}
