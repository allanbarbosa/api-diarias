<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ClasseSeeder::class);
        $this->call(EscolaridadeSeeder::class);
        $this->call(ProfissaoSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(GratificacaoSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(PaisSeeder::class);
    }
}
