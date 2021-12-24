<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class Migrations extends Model
{
    public $connection = "mysql";

    public $table = "migrations";

    public $primary_key = "id";

    
	public $id;
	public $migration;
	public $batch;

}