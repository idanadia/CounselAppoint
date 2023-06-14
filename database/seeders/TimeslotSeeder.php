<?php
namespace Database\Seeders;

use App\Models\Timeslot;
use Illuminate\Database\Seeder;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeslots_seeds = [
            [
                'counselorId' => 4,
                'startTime' => '2023-05-30 8:00:00',
                'endTime' => '2023-05-30 9:00:00',
                'isActive' => true,
            ],
            [
                'counselorId' => 4,
                'startTime' => '2023-05-30 9:00:00',
                'endTime' => '2023-05-30 10:00:00',
                'isActive' => true,
            ],
            [
                'counselorId' => 4,
                'startTime' => '2023-05-30 10:00:00',
                'endTime' => '2023-05-30 11:00:00',
                'isActive' => false,
            ],
            [
                'counselorId' => 4,
                'startTime' => '2023-05-30 11:00:00',
                'endTime' => '2023-05-30 12:00:00',
                'isActive' => true,
            ],
            [
                'counselorId' => 4,
                'startTime' => '2023-05-30 12:00:00',
                'endTime' => '2023-05-30 13:00:00',
                'isActive' => true,
            ],
            [
                'counselorId' => 4,
                'startTime' => '2023-05-30 13:00:00',
                'endTime' => '2023-05-30 14:00:00',
                'isActive' => true,
            ],
        ];

        foreach ($timeslots_seeds as $timeslots_seed) {
            Timeslot::firstOrCreate($timeslots_seed);
        }
    }
}
