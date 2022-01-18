<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class Audit extends Model
{
    public $connection = "mysql";

    public $table = "audit";

    public $primary_key = "id";

    
	public $id;
	public $name;
	public $purpose;
	public $audit_date;
	public $audit_area;
	public $audit_by;
	public $audit_leader;
	public $siklus_number;
	public $siklus_year;
	public $status;
	public $created_at;
	public $updated_at;
	public $fakultas_id;
	public $unit;
	public $code;
	public $template_code;
	public $status_publish;
	public $deleted_at;
	public $location;
	public $criteria;

}