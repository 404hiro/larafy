<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ippan = Role::where("title", "一般ユーザー")->first();
        $dev = Role::where("title", "開発者")->first();
        User::create([
            'name' => '一般ユーザー',
            'email' => 'user@example.com',
            'uuid' => Str::uuid(),
            'role_id' => $ippan->id,
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'システム管理者',
            'email' => 'admin@example.com',
            'uuid' => Str::uuid(),
            'role_id' => $dev->id,
            'password' => Hash::make('password'),
        ]);
    }
}
