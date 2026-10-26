<?php

namespace Database\Seeders;

use App\Models\Dentist;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Creates one working account per user type (needed for the submission)
 * plus the dentist record linked to the dentist account.
 *
 *   Admin    -> username: admin     password: Admin@12345
 *   Dentist  -> username: dentist   password: Dentist@12345
 *   Employee -> username: employee  password: Employee@12345
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Clinic Administrator',
                'email' => 'admin@dentalclinic.test',
                'password' => 'Admin@12345',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $dentistUser = User::updateOrCreate(
            ['username' => 'dentist'],
            [
                'name' => 'Dr. Maria Santos',
                'email' => 'dentist@dentalclinic.test',
                'password' => 'Dentist@12345',
                'role' => 'dentist',
                'email_verified_at' => now(),
            ]
        );

        Dentist::updateOrCreate(
            ['user_id' => $dentistUser->id],
            [
                'dentist_name' => 'Dr. Maria Santos',
                'specialization' => 'General Dentistry',
                'contact_information' => '0917 000 0000',
            ]
        );

        User::updateOrCreate(
            ['username' => 'employee'],
            [
                'name' => 'Front Desk Staff',
                'email' => 'employee@dentalclinic.test',
                'password' => 'Employee@12345',
                'role' => 'employee',
                'email_verified_at' => now(),
            ]
        );
    }
}
