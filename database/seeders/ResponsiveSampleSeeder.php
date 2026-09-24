<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Sample data for checking the admin panel on phones and tablets:
 *  - 75 contact enquiries (admin-only list) so the Contact list runs to 9+ pages;
 *  - a three-level course-category branch under "Judiciary Examination".
 *
 * Every row is tagged so it can be removed again:
 *   contact_forms.email ends with "@sample.lawstudents.test"
 *   categories.slug starts with "sample-rt-"
 *
 * Add:    php artisan db:seed --class=ResponsiveSampleSeeder
 * Remove: php artisan db:seed --class=RemoveResponsiveSampleSeeder
 */
class ResponsiveSampleSeeder extends Seeder
{
    public const EMAIL_DOMAIN = '@sample.lawstudents.test';
    public const SLUG_PREFIX = 'sample-rt-';

    public function run(): void
    {
        (new RemoveResponsiveSampleSeeder())->run();

        $this->seedContactEnquiries();
        $this->seedCategoryBranch();
    }

    private function seedContactEnquiries(): void
    {
        $people = [
            ['Aishwarya', 'Raghunathan'], ['Rohan', 'Mehta'], ['Sneha', 'Kulkarni'], ['Arjun', 'Bhattacharya'],
            ['Priyanka', 'Chatterjee'], ['Vikram', 'Singh Rathore'], ['Ananya', 'Iyer'], ['Mohammed', 'Faizan'],
            ['Kavya', 'Deshpande'], ['Siddharth', 'Banerjee'], ['Nandini', 'Venkataraman'], ['Aditya', 'Chaudhary'],
            ['Ishita', 'Sengupta'], ['Rahul', 'Mukherjee'], ['Fatima', 'Siddiqui'],
        ];

        $programmes = [
            'LL.B. - 3 Years', 'LL.B. - 5 Years', 'LL.M.', 'Judiciary Examination', 'LL.B. Entrance Examination',
            'CSEET', 'Constitutional Law', 'Legal Drafting & Conveyancing Workshop',
        ];

        $messages = [
            'Please share the fee structure and batch timings for the weekend classes.',
            'I am preparing for the West Bengal Judicial Service examination. Do you provide answer-writing practice and mock interviews for the personality test?',
            'Is the course available online? I work on weekdays and can only attend classes on Saturday and Sunday evenings.',
            'I have completed my 3-year LL.B. from Calcutta University and want to enrol for LL.M. coaching. Could you tell me the duration, study material provided and whether previous years\' question papers are covered in detail?',
            'Do you offer a free demo class before admission?',
            'I would like to know whether notes for the Code of Civil Procedure and the Indian Evidence Act (now the Bharatiya Sakshya Adhiniyam) are included in the course material, and how often they are updated after new amendments.',
            'Can I pay the course fee in instalments?',
            'My daughter is in Class 12 and wants to prepare for CLAT alongside her board exams. Which batch would suit her, and do you provide doubt-clearing sessions?',
        ];

        $rows = [];
        $start = Carbon::now()->subDays(80);

        for ($i = 0; $i < 75; $i++) {
            [$first, $last] = $people[$i % count($people)];
            $emailName = strtolower(str_replace(' ', '.', $first . '.' . $last)) . ($i >= count($people) ? '.' . ($i + 1) : '');
            $created = $start->copy()->addHours($i * 25);

            $rows[] = [
                'first_name' => $first,
                'last_name' => $last,
                'phone' => '+9198' . str_pad((string) (31000000 + $i * 7919), 8, '0', STR_PAD_LEFT),
                'email' => $emailName . self::EMAIL_DOMAIN,
                'service_type' => $programmes[$i % count($programmes)],
                'message' => $messages[$i % count($messages)],
                'delete' => 1,
                'created_at' => $created,
                'updated_at' => $created,
            ];
        }

        DB::table('contact_forms')->insert($rows);
    }

    private function seedCategoryBranch(): void
    {
        $root = DB::table('categories')->where('name', 'Judiciary Examination')->where('delete', 1)->value('id');
        $now = Carbon::now();

        $parent = $root;
        $levels = [
            ['State Judicial Services (PCS-J)', 'Civil Judge (Junior Division) examinations conducted by the state public service commissions and high courts.'],
            ['Uttar Pradesh PCS-J', 'Preliminary, main examination and interview for the Uttar Pradesh Judicial Service.'],
            ['UP PCS-J Main Examination - Law Papers I, II & III', 'Substantive law, procedure and evidence, and revenue and criminal law papers for the main examination.'],
        ];

        foreach ($levels as $i => [$name, $description]) {
            $parent = DB::table('categories')->insertGetId([
                'name' => $name,
                'slug' => self::SLUG_PREFIX . \Illuminate\Support\Str::slug($name),
                'description' => $description,
                'parent_id' => $parent,
                'status' => 1,
                'sort_order' => $i,
                'delete' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
