<?php

namespace Database\Seeders;

use App\Models\Statut;
use Illuminate\Database\Seeder;

class CreateStatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['id' => 1, 'description' => 'Pas encore commencé'],
            ['id' => 2, 'description' => 'En cours'],
            ['id' => 3, 'description' => 'Suspendu'],
            ['id' => 4, 'description' => 'Terminé']
        ];         

        Statut::insert($status);
    }


}
