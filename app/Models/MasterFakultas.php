<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class MasterFakultas extends Model
{
    public $connection = "mysql";

    public $table = "master_fakultas";

    public $primary_key = "id";

    
	public $id;
	public $name;
	public $created_at;
	public $updated_at;

}