<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class AuditKelengkapan extends Model
{
    public $connection = "mysql";

    public $table = "audit_kelengkapan";

    public $primary_key = "id";

    
	public $id;
	public $audit_id;
	public $answer_by;
	public $users_id;
	public $created_at;
	public $updated_at;

}