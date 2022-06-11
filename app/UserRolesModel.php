<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRolesModel extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    public static function pluckUnitIdByUsersId($users_id)
    {
        return self::query()
            ->where('users_id', '=', $users_id)
            ->pluck('master_unit_id')
            ->toArray();
    }
}
