<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'title' => '開発者',
            'role' => 1,
        ]);
        \App\Models\Role::create([
            'title' => 'システム管理者',
            'role' => 5,
        ]);
        \App\Models\Role::create([
            'title' => '一般ユーザー',
            'role' => 10,
        ]);
        \App\Models\Role::create([
            'title' => 'アク禁',
            'role' => 11,
        ]);
    }
}
