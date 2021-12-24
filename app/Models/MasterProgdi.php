<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class MasterProgdi extends Model
{
    public $connection = "mysql";

    public $table = "master_progdi";

    public $primary_key = "id";

    
	public $id;
	public $fakultas_id;
	public $name;
	public $created_at;
	public $updated_at;
	public $jenjang;

}