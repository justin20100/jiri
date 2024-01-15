<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\ContactDuty;
use App\Models\ContactJiri;
use App\Models\Jiri;
use App\Models\JiriProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()
            ->create([
                'avatar' => 'defaultavatar.jpg',
                'firstname' => 'adminFirst',
                'lastname' => 'adminLast',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ]);

        $user2 = User::factory()
            ->create([
                'avatar' => 'defaultavatar.jpg',
                'firstname' => 'Justin',
                'lastname' => 'Vincent',
                'email' => 'justinvincent@gmail.com',
                'password' => bcrypt('admin'),
            ]);

        $users = collect([$user1, $user2]);

        foreach ($users as $user) {
            Jiri::factory()->count(32)->create([
                'user_id' => $user->id,
            ]);

            Contact::factory()->count(25)->create([
                'user_id' => $user->id,
            ]);

            Project::factory()->count(12)->create([
                'user_id' => $user->id,
            ]);

            $jiris = $user->jiris;

            foreach ($jiris as $jiri) {
                $contacts = $user->contacts->random(3);

                foreach ($contacts as $contact) {
                    ContactJiri::factory()->count(8)->create([
                        'jiri_id' => $jiri->id,
                        'contact_id' => $contact->id,
                    ]);
                }
            }

            foreach ($jiris as $jiri) {
                $projects = $user->projects->random(3);

                foreach ($projects as $project) {
                    JiriProject::factory()->count(2)->create([
                        'jiri_id' => $jiri->id,
                        'project_id' => $project->id,
                    ]);
                }
            }

            foreach ($jiris as $jiri) {
                $jiriProjects = $jiri->jiriProjects;

                foreach ($jiriProjects as $jiriProject) {
                    $contacts = $jiri->contacts->random(2);

                    foreach ($contacts as $contact) {
                        ContactDuty::factory()->count(1)->create([
                            'jiri_id' => $jiri->id,
                            'contact_id' => $contact->id,
                            'project_id' => $jiriProject->project_id,
                        ]);
                    }
                }
            }
        }
    }
}
