<?php
namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symptom_seeds = [
            ['id' => '1', 'symptom_name' => 'Parut dan bekas suntikan di lengan dan di hujung jari bertukar warna akubat menghisap dadah'],
            ['id' => '2', 'symptom_name' => 'Kemerosotan kehadiran (sekolah atau tempat kerja) mutu kerja, disiplin dan hasil kerja'],
            ['id' => '3', 'symptom_name' => 'Kemerosotan kebersihan diri dan paras rupa'],
            ['id' => '4', 'symptom_name' => 'Hidung kerap berdarah'],
            ['id' => '5', 'symptom_name' => 'Kesan terbakar di mulut atau jari'],
            ['id' => '6', 'symptom_name' => 'Ujian Air Kencing Positif'],
            ['id' => '7', 'symptom_name' => 'Meradang tidak tentu sebab, selalu menguap dan tidak bermaya'],
            ['id' => '8', 'symptom_name' => 'Tabiat suka menyembunyikan apa-apa yang dilakukan atau dimiliki'],
            ['id' => '9', 'symptom_name' => 'Mengelakkan diri dari tanggungjawab'],
            ['id' => '10', 'symptom_name' => 'Hilang selera makan (kurang berat badan)'],
            ['id' => '11', 'symptom_name' => 'Mata berkaca-kaca, berair atau kemerah-merahan'],
            ['id' => '12', 'symptom_name' => 'Badan atau Anggota Badan menggeletar'],
            ['id' => '13', 'symptom_name' => 'Percakapan tidak lancar'],
            ['id' => '14', 'symptom_name' => 'Pernafasan berbau'],
            // ['id'=>'6','symptom_name'=>'Saturday'],
            // ['id'=>'7','symptom_name'=>'Sunday'],
        ];

        foreach ($symptom_seeds as $symptom_seeds) {
            Symptom::firstOrCreate($symptom_seeds);

        }
    }
}
