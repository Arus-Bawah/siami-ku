<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class AnggotaAuditor extends Model
{
    public $connection = "mysql";

    public $table = "anggota_auditor";

    public $primary_key = "id";

    
	public $id;
	public $audit_id;
	public $name;
	public $created_at;
	public $updated_at;

}