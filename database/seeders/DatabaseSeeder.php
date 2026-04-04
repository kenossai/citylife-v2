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
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@citylife.com',
        ])->assignRole('super_admin');

        $this->call(HomepageSeeder::class);
        $this->call(AboutPageSeeder::class);
        $this->call(MinistrySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SermonSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(SpeakerSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
