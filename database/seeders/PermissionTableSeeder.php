<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'afficher utilisateur',
            'créer utilisateur',
            'modifier utilisateur',

            'afficher rôle',
            'créer rôle',
            'modifier rôle',

            'afficher sujet',
            'créer sujet',
            'modifier sujet',

            'afficher stage',
            'créer stage',
            'modifier stage',

            'afficher service',
            'créer service',
            'modifier service',

            'afficher stagiaire',
            'créer stagiaire',
            'modifier stagiaire',

            'afficher département',
            'créer département',
            'modifier département'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
