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
        // Creation de deux users
        $user1 = User::factory()
            ->create([
                'avatar' => 'defaultAvatar.jpg',
                'firstname' => 'adminFirstName',
                'lastname' => 'adminLastName',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Admin1234'),
            ]);
        $user2 = User::factory()
            ->create([
                'avatar' => 'defaultAvatar.jpg',
                'firstname' => 'Justin',
                'lastname' => 'Vincent',
                'email' => 'justinvincent@gmail.com',
                'password' => bcrypt('Admin1234'),
            ]);@
        $users = collect([$user1, $user2]);

        foreach ($users as $user) {

            // Création de contacts
            Contact::factory()->count(20)->create([
                'user_id' => $user->id,
            ]);

            // Création de projets
            Project::factory()->count(10)->create([
                'user_id' => $user->id,
            ]);

            // Création de jiris
            Jiri::factory()->count(5)->create([
                'user_id' => $user->id,
            ]);

            $jiris = $user->jiris;

            // Ajout de contacts aux jiris
            foreach ($jiris as $jiri) {
                $contacts = $user->contacts->random(3);

                foreach ($contacts as $contact) {
                    ContactJiri::factory()->count(8)->create([
                        'jiri_id' => $jiri->id,
                        'contact_id' => $contact->id,
                    ]);
                }
            }

            // Ajout de projets aux jiris
            foreach ($jiris as $jiri) {
                $projects = $user->projects->random(3);

                foreach ($projects as $project) {
                    JiriProject::factory()->count(2)->create([
                        'jiri_id' => $jiri->id,
                        'project_id' => $project->id,
                    ]);
                }
            }

            // Ajout de points de contact aux projets
            foreach ($jiris as $jiri) {
                $jiriProjects = $jiri->jiriProjects;

                foreach ($jiriProjects as $jiriProject) {
                    $contacts = $jiri->contacts->random(2);

                    foreach ($contacts as $contact) {
                        ContactDuty::factory()->count(1)->create([
                            'contact_id' => $contact->id,
                            'jiri_project_id' => $jiriProject->project_id,
                        ]);
                    }
                }
            }
        }

        // Création de projets sans jiris pour l'utilisateur 1
        $projects = ['Projet web Jiri', 'Design Web', 'Portfolio', 'Projet de fin d\'études'];
        Project::factory()->count(4)->create(['user_id' => 1])
            ->each(function ($project, $index) use ($projects) {
                $project->title = $projects[$index];
                $project->save();
            });
    }
}
