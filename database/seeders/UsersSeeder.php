<?php

namespace Database\Seeders;

use App\MasterUnitTipeModel;
use App\UserRolesModel;
use App\UsersModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get data from file json
        $data = file_get_contents(base_path('database/file/users.json'));
        $json = json_decode($data);

        // buat tmp unit tipe dan unitnya
        $unit = [];
        $unit_tipe = MasterUnitTipeModel::all();
        foreach ($unit_tipe as $row) {
            foreach ($row->masterUnit as $xrow) {
                $unit[$row->id][] = $xrow;
            }
        }

        // buat tmp users untuk indexing
        $list_user = UsersModel::all()->pluck('id')->toArray();

        // buat tmp user role
        $list_user_roles = [];
        $user_roles = UserRolesModel::all();
        foreach ($user_roles as $row) {
            $list_user_roles[] = $row->users_id . '|' . $row->master_unit_tipe_id . '|' . $row->master_unit_id;
        }

        // insert data
        $password = Hash::make('123456');
        foreach ($json as $i => $row) {
            if (!in_array($row->id, $list_user)) {
                UsersModel::create([
                    'id' => $row->id,
                    'name' => $row->name,
                    'email' => $row->email,
                    'password' => $password,
                    'role' => $row->role,
                    'foto' => $row->foto,
                    'jabatan' => $row->jabatan,
                    'tanda_tangan' => $row->tanda_tangan
                ]);
            }

            // insert roles
            if ($row->unit_tipe_id != "" && isset($unit[$row->unit_tipe_id])) {
                foreach ($unit[$row->unit_tipe_id] as $j => $xrow) {
                    // validate if data existing
                    $key = $row->id . '|' . $row->unit_tipe_id . '|' . $xrow->id;
                    if (in_array($key, $list_user_roles)) continue;

                    UserRolesModel::create([
                        'users_id' => $row->id,
                        'master_unit_tipe_id' => $row->unit_tipe_id,
                        'master_unit_id' => $xrow->id,
                    ]);
                }
            }
        }
    }
}
