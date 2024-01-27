<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name','Admin')->first();
        $customer = Role::where('name', 'Registered User')->first();
        $editingProducts = Permission::where('name','Editing products')->first();
        $viewingProducts = Permission::where('name','Viewing products')->first();
        $user1 = new User();
        $user1->name = 'Jhon Deo';
        $user1->email = 'jhon@deo.com';
        $user1->password = bcrypt('password');
        $user1->birthday = fake()->date();
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($editingProducts);
        $user2 = new User();
        $user2->name = 'Mike Thomas';
        $user2->email = 'mike@thomas.com';
        $user2->password = bcrypt('password');
        $user2->birthday = fake()->date();
        $user2->save();
        $user2->roles()->attach($customer);
        $user2->permissions()->attach($viewingProducts);
    }
}
