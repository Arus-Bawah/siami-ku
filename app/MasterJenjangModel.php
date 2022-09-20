<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenjangModel extends Model
{
    use HasFactory;

    protected $table = 'master_jenjang';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function getJenjang()
    {
        return self::query()
            ->select('id', 'jenjang as value')
            ->orderBy('jenjang', 'ASC')
            ->get();
    }
}
