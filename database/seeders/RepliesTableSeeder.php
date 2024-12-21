<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('replies')->insert([
            [
                'review_id' => 1,
                'user_id' => 3,
                'comment' => 'Absolutely! Suzanne Collins masterfully weaves a story that\'s as emotional as it is thrilling. Katniss\'s strength and resilience make her such a compelling protagonist, and the tension in the Games is unmatched.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => 1,
                'user_id' => 15,
                'comment' => 'It’s such a page-turner!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => 16,
                'user_id' => 22,
                'comment' => 'The humor truly shines amidst the chaos, making every moment unforgettable and surprisingly uplifting.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => 20,
                'user_id' => 10,
                'comment' => 'Its magical charm and emotional depth set the perfect tone for a story that resonates with readers of all ages.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => 24,
                'user_id' => 27,
                'comment' => 'The seamless blend of wit and depth makes this an extraordinary tale that’s both entertaining and thought-provoking.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => 52,
                'user_id' => 48,
                'comment' => 'The emotional intensity of this sequel hits hard, weaving love and resilience into an unforgettable narrative.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
