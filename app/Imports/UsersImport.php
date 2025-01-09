<?php 
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $user = User::create([
                'name' => $row['name'],
                'nisn' => $row['nisn'],
                'email' => $row['nisn'] . '@example.com',
                'password' => Hash::make('123456'),
            ]);

            $user->assignRole('alumni');

            return $user;
        } catch (\Exception $e) {
            // Log error atau handle sesuai kebutuhan
            return null;
        }
    }
}