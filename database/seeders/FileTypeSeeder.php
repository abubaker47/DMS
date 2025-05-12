<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileTypes = [
            [
                'name' => 'PDF Document',
                'name_dari' => 'سند PDF',
                'name_pashto' => 'PDF سند',
                'extension' => 'pdf',
                'mime_type' => 'application/pdf',
                'is_active' => true,
            ],
            [
                'name' => 'Word Document',
                'name_dari' => 'سند Word',
                'name_pashto' => 'Word سند',
                'extension' => 'docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'is_active' => true,
            ],
            [
                'name' => 'Excel Spreadsheet',
                'name_dari' => 'صفحه گسترده Excel',
                'name_pashto' => 'Excel پاڼه',
                'extension' => 'xlsx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'is_active' => true,
            ],
            [
                'name' => 'PowerPoint Presentation',
                'name_dari' => 'ارائه PowerPoint',
                'name_pashto' => 'PowerPoint وړاندې کول',
                'extension' => 'pptx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'is_active' => true,
            ],
            [
                'name' => 'Image (JPEG)',
                'name_dari' => 'تصویر (JPEG)',
                'name_pashto' => 'انځور (JPEG)',
                'extension' => 'jpg',
                'mime_type' => 'image/jpeg',
                'is_active' => true,
            ],
            [
                'name' => 'Image (PNG)',
                'name_dari' => 'تصویر (PNG)',
                'name_pashto' => 'انځور (PNG)',
                'extension' => 'png',
                'mime_type' => 'image/png',
                'is_active' => true,
            ],
            [
                'name' => 'Text File',
                'name_dari' => 'فایل متنی',
                'name_pashto' => 'متن فایل',
                'extension' => 'txt',
                'mime_type' => 'text/plain',
                'is_active' => true,
            ],
        ];

        foreach ($fileTypes as $fileType) {
            FileType::create($fileType);
        }
    }
}
