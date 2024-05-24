<?php

namespace Database\Seeders;

use App\Models\DeleteRequestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeleteRequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusNames = [
            'در انتظار بررسی',
            'تایید شده',
            'رد شده'
        ];

        foreach ($statusNames as $statusName)
        {
            DeleteRequestStatus::query()->create([
                'name' => $statusName
            ]);
        }
    }
}
