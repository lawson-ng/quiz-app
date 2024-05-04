<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Oex_exam_master;

class ExamSeeder extends Seeder
{
    protected $category;

    public function setCategory($categoryId)
    {
        $this->category = $categoryId;
        return $this;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo dữ liệu mẫu cho model Exam với Category tương ứng
        $faker = \Faker\Factory::create();
        foreach (range(1, 10) as $index) {
            Oex_exam_master::create([
                'title' => $faker->sentence,
                'category' =>  $this->category,
                'exam_date' => 100,
                'exam_duration' => $faker->numberBetween(60, 180),
                'status' => 1,
            ]);
        }
    }
}
