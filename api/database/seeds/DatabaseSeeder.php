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
        $this->call(EscolaridadeSeeder::class);
        $this->call(ProfissaoSeeder::class);
    }
}
