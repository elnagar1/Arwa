<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Settings
        \App\Models\Setting::insert([
            ['key' => 'whatsapp_number', 'value' => '01033466109'],
            ['key' => 'instructor_name_ar', 'value' => 'أ. أروى عبد الرحمن'],
            ['key' => 'instructor_name_en', 'value' => 'Ms. Arwa Abdulrahman'],
            ['key' => 'instructor_role_ar', 'value' => 'أستاذة علوم الحاسب والبرمجة'],
            ['key' => 'instructor_role_en', 'value' => 'Computer Science & Programming Instructor'],
            ['key' => 'instructor_bio_ar', 'value' => 'متخصصة في تبسيط مفاهيم البرمجة والأنظمة العددية للطلاب بخبرة تزيد عن 7 سنوات في تدريس المناهج التقنية.'],
            ['key' => 'instructor_bio_en', 'value' => 'Specialized in simplifying programming concepts and numeral systems for students with over 7 years of experience in teaching technical curricula.'],
            ['key' => 'instructor_image_url', 'value' => '/assets/arwa_profile.jpg'],
        ]);

        $course = \App\Models\Course::create([
            'title' => 'كورس أساسيات علوم الحاسب',
            'description' => 'مقدمة شاملة لأساسيات الحوسبة والأنظمة العددية والخوارزميات',
        ]);

        \App\Models\Video::create([
            'course_id' => $course->id,
            'title' => 'الدرس الأول: مقدمة المنهج',
            'description' => 'فيديو تجريبي للدرس الأول',
            'youtube_url' => 'https://www.youtube.com/watch?v=SBs7ExM4UbI',
            'notes_url' => 'https://example.com/notes.pdf',
            'quiz_url' => 'https://forms.gle/dummy1',
            'available_from' => now()->subDay(), // متاح من الأمس
            'available_until' => now()->addDays(7), // متاح لمدة أسبوع
        ]);

        \App\Models\Video::create([
            'course_id' => $course->id,
            'title' => 'الدرس الثاني: الأنظمة العددية (Number Systems)',
            'description' => 'شرح أنظمة العد',
            'youtube_url' => 'https://www.youtube.com/watch?v=jrie9C4eM3I',
            'notes_url' => 'https://example.com/notes2.pdf',
            'quiz_url' => 'https://forms.gle/dummy2',
            'available_from' => now()->addDays(2), // متاح بعد يومين (مغلق حالياً)
            'available_until' => now()->addDays(9),
        ]);

        \App\Models\Video::create([
            'course_id' => $course->id,
            'title' => 'الدرس الثالث: البوابات المنطقية (Logic Gates)',
            'description' => 'شرح البوابات المنطقية',
            'youtube_url' => 'https://www.youtube.com/watch?v=dummy2',
            'available_from' => null, // متاح دائماً
            'available_until' => null,
            'is_locked' => true,
        ]);
        
        \App\Models\Video::create([
            'course_id' => $course->id,
            'title' => 'الدرس الرابع: الخوارزميات (Algorithms)',
            'description' => 'الخوارزميات والبرمجة',
            'youtube_url' => 'https://www.youtube.com/watch?v=dummy3',
            'available_from' => null,
            'available_until' => now()->subDay(), // منتهي (مغلق حالياً)
        ]);
    }
}
