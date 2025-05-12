<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Administration',
                'name_dari' => 'اداره',
                'name_pashto' => 'اداره',
                'description' => 'Administrative department',
                'description_dari' => 'دیپارتمنت اداری',
                'description_pashto' => 'اداري څانګه',
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'name_dari' => 'مالی',
                'name_pashto' => 'مالي',
                'description' => 'Finance department',
                'description_dari' => 'دیپارتمنت مالی',
                'description_pashto' => 'مالي څانګه',
                'is_active' => true,
            ],
            [
                'name' => 'Human Resources',
                'name_dari' => 'منابع بشری',
                'name_pashto' => 'بشري سرچینې',
                'description' => 'Human Resources department',
                'description_dari' => 'دیپارتمنت منابع بشری',
                'description_pashto' => 'د بشري سرچینو څانګه',
                'is_active' => true,
            ],
            [
                'name' => 'IT',
                'name_dari' => 'تکنالوژی معلوماتی',
                'name_pashto' => 'معلوماتي ټکنالوژي',
                'description' => 'Information Technology department',
                'description_dari' => 'دیپارتمنت تکنالوژی معلوماتی',
                'description_pashto' => 'د معلوماتي ټکنالوژۍ څانګه',
                'is_active' => true,
            ],
            [
                'name' => 'Legal',
                'name_dari' => 'حقوقی',
                'name_pashto' => 'حقوقي',
                'description' => 'Legal department',
                'description_dari' => 'دیپارتمنت حقوقی',
                'description_pashto' => 'حقوقي څانګه',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
