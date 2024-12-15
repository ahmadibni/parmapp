<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = Role::create([
            'name' => 'owner',
        ]);

        $buyer = Role::create([
            'name' => 'buyer',
        ]);

        $user = User::create([
            'name' => 'Ahmad Ibni Abdillah',
            'email' => 'ahmad.ibni@parma.com',
            'password' => bcrypt('952001@Ibni')
        ]);

        $user->assignRole($owner);
    }
}
