<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        //Insertar elementos en mi tabla
        //DB::table('users')->insert([
        //    'name' => 'Administrator',
        //    'email' => 'admin@gmail.com',
        //    'password' => Hash::make('password')
        //]);

        // Lista de usuarios
        $users = [
            ['name' => 'Héctor Aguilar Méndez', 'email' => 'hector.aguilar@gmail.com'],
            ['name' => 'Patricia Delgado Ruiz', 'email' => 'patricia.delgado@gmail.com'],
            ['name' => 'Iván Ortega Salgado', 'email' => 'ivan.ortega@gmail.com'],
            ['name' => 'Claudia Reyes Navarro', 'email' => 'claudia.reyes@gmail.com'],
            ['name' => 'Arturo Campos Zúñiga', 'email' => 'arturo.campos@gmail.com'],
            ['name' => 'Verónica Rivas Soto', 'email' => 'veronica.rivas@gmail.com'],
            ['name' => 'Raúl Castillo Méndez', 'email' => 'raul.castillo@gmail.com'],
            ['name' => 'Natalia Espinoza Vargas', 'email' => 'natalia.espinoza@gmail.com'],
            ['name' => 'Óscar Domínguez León', 'email' => 'oscar.dominguez@gmail.com'],
            ['name' => 'Lucía Cabrera Flores', 'email' => 'lucia.cabrera@gmail.com'],
            ['name' => 'Emilio Peña Cortés', 'email' => 'emilio.pena@gmail.com'],
            ['name' => 'Andrea Solís Herrera', 'email' => 'andrea.solis@gmail.com'],
            ['name' => 'Tomás Valdez Guerrero', 'email' => 'tomas.valdez@gmail.com'],
            ['name' => 'Mariana Ibarra Cruz', 'email' => 'mariana.ibarra@gmail.com'],
            ['name' => 'Gerardo Ponce Serrano', 'email' => 'gerardo.ponce@gmail.com'],
            ['name' => 'Renata Beltrán Rojas', 'email' => 'renata.beltran@gmail.com'],
            ['name' => 'Alonso Figueroa Méndez', 'email' => 'alonso.figueroa@gmail.com'],
            ['name' => 'Camila Treviño Salas', 'email' => 'camila.trevino@gmail.com'],
            ['name' => 'Bruno Cárdenas Vázquez', 'email' => 'bruno.cardenas@gmail.com'],
            ['name' => 'Elena Galván Paredes', 'email' => 'elena.galvan@gmail.com'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password')
            ]);
        }
    }
}
