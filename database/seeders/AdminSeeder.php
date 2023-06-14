<?php
namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_seeds = [
            [
                'fullName' => 'Client User',
                'email' => 'client@counselAppoint.com',
                'course' => 'B20',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'matricId' => 'B20EC0027',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 0,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Client User 2',
                'email' => 'client2@counselAppoint.com',
                'course' => 'B20',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'matricId' => 'B20EC0027',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 0,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Client User 3',
                'email' => 'client3@counselAppoint.com',
                'course' => 'B20',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'matricId' => 'B20EC0027',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 0,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Counsellor User',
                'email' => 'counselor@counselAppoint.com',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'qualification' => 'UTM Dengree',
                'roomLocation' => 'BL-40-2',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 1,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Counsellor 2 User',
                'email' => 'counselor2@counselAppoint.com',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'qualification' => 'UTM Dengree',
                'roomLocation' => 'BL-40-2',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 1,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Counsellor 3 User',
                'email' => 'counselor3@counselAppoint.com',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'qualification' => 'UTM Dengree',
                'roomLocation' => 'BL-40-2',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 1,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Counsellor 4 User',
                'email' => 'counselor4@counselAppoint.com',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'qualification' => 'UTM Dengree',
                'roomLocation' => 'BL-40-2',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 1,
                'icNo' => '1234567890',
            ],
            [
                'fullName' => 'Supervisor User',
                'email' => 'supervisor@counselAppoint.com',
                'password' => Hash::make('password'),
                'phoneNo' => '0123456789',
                'address' => '12 Jalan Pulau Angsa u10/1e',
                'nationality' => 'Malaysian',
                'qualification' => 'UTM Dengree',
                'roomLocation' => 'BL-40-2',
                'faculty' => 'Faculty of Engineering',
                'department' => 'SASMO',
                'role' => 2,
                'icNo' => '1234567890',
            ],

        ];

        foreach ($user_seeds as $user_seed) {
            User::firstOrCreate($user_seed);

        }
    }
}
