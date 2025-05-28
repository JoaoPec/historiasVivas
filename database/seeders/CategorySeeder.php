<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Família',
                'description' => 'Memórias relacionadas à família, como nascimentos, casamentos e reuniões familiares',
                'icon' => 'users',
                'color' => '#2A7D6B', // teal
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Viagens',
                'description' => 'Memórias de viagens e passeios realizados',
                'icon' => 'map',
                'color' => '#F5A623', // amber
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Celebrações',
                'description' => 'Memórias de festas, aniversários e outras celebrações',
                'icon' => 'cake',
                'color' => '#E74C3C', // vermelho
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Conquistas',
                'description' => 'Memórias de conquistas pessoais e profissionais',
                'icon' => 'award',
                'color' => '#3498DB', // azul
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Carreira',
                'description' => 'Memórias relacionadas à vida profissional',
                'icon' => 'briefcase',
                'color' => '#9B59B6', // roxo
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Infância',
                'description' => 'Memórias específicas da infância',
                'icon' => 'child',
                'color' => '#2ECC71', // verde
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Educação',
                'description' => 'Memórias relacionadas a estudos e formação acadêmica',
                'icon' => 'book',
                'color' => '#F39C12', // laranja
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Amizades',
                'description' => 'Memórias com amigos e momentos de companheirismo',
                'icon' => 'heart',
                'color' => '#E83E8C', // rosa
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Hobbies',
                'description' => 'Memórias relacionadas a passatempos e atividades de lazer',
                'icon' => 'music',
                'color' => '#6C757D', // cinza
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Esportes',
                'description' => 'Memórias de atividades esportivas e competições',
                'icon' => 'activity',
                'color' => '#17A2B8', // ciano
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
