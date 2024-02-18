<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Enums\RoleName;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $this->createAdminUser();
    $this->createVendorUser();
    $this->createStaffUser();
    $this->createCustomerUser();
  }

  public function createAdminUser()
  {
    User::create([
      'name'     => 'Admin User',
      'email'    => 'admin@admin.com',
      'password' => bcrypt('asdfasdf'),
    ])->roles()->sync(Role::where('name', RoleName::ADMIN->value)->first());
  }

  public function createVendorUser()
  {
    $vendor = User::create([
      'name'     => 'Restaurant owner',
      'email'    => 'vendor@admin.com',
      'password' => bcrypt('asdfasdf'),
    ]);

    $vendor->roles()->sync(Role::where('name', RoleName::VENDOR->value)->first());

    $vendor->restaurant()->create([
      'city_id' => City::where('name', 'Zenica')->value('id'),
      'name'    => 'Restaurant 001',
      'address' => 'Address SJV14',
    ]);
  }

  public function createStaffUser()
  {
    $vendor = User::create([
      'name'     => 'Staff',
      'email'    => 'staff@gmail.com',
      'password' => bcrypt('asdfasdf'),
    ]);

    $vendor->roles()->sync(Role::where('name', RoleName::STAFF->value)->first());

    $vendor->restaurant()->create([
      'city_id' => City::where('name', 'Zenica')->value('id'),
      'name'    => 'Restaurant Staff',
      'address' => 'Address SJV14',
    ]);
  }

  public function createCustomerUser()
  {
    $vendor = User::create([
      'name'     => 'Customer',
      'email'    => 'customer@gmail.com',
      'password' => bcrypt('asdfasdf'),
    ]);

    $vendor->roles()->sync(Role::where('name', RoleName::CUSTOMER->value)->first());
  }
}
