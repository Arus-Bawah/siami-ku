<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function findBy($field, $value)
    {
        return self::query()
            ->where($field, $value)
            ->first();
    }

    public static function getIndex(int $limit = 20, string $search = '', array $filter = [])
    {
        return self::query()
            ->where(function ($q) use ($filter) {
                if (isset($filter['name']) && $filter['name'] != '') {
                    $q->where('name', 'LIKE', '%' . $filter['name'] . '%');
                }
                if (isset($filter['email']) && $filter['email'] != '') {
                    $q->where('email', 'LIKE', '%' . $filter['email'] . '%');
                }
                if (isset($filter['jabatan']) && $filter['jabatan'] != '') {
                    $q->where('jabatan', 'LIKE', '%' . $filter['jabatan'] . '%');
                }
            })
            ->where(function ($q) use ($search) {
                $q->orWhere('name', 'LIKE', '%' . $search . '%');
                $q->orWhere('email', 'LIKE', '%' . $search . '%');
                $q->orWhere('jabatan', 'LIKE', '%' . $search . '%');
            })
            ->where('role', '!=', 'LPM')
            ->orderBy('id', 'DESC')
            ->paginate($limit);
    }
}
