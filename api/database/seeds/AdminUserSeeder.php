<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \Diarias\Usuario\Models\UsuarioModel::where('usua_login', '=', 'admin')->first();

        if (!$admin) {

            $adminModel = new \Diarias\Usuario\Models\UsuarioModel();

            $adminModel->usua_login = 'admin';
            $adminModel->usua_senha = \Illuminate\Support\Facades\Hash::make('conder');
            $adminModel->usua_nome = 'Administrador';
            $adminModel->usua_primeiro_acesso = false;

            $adminModel->save();
        }
    }
}
