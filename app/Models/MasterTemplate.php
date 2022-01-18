<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class MasterTemplate extends Model
{
    public $connection = "mysql";

    public $table = "master_template";

    public $primary_key = "id";

    
	public $id;
	public $name;
	public $unit;
	public $purpose;
	public $audit_area;
	public $criteria;
	public $created_at;
	public $updated_at;

}