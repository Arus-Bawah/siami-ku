<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class AuditTemuan extends Model
{
    public $connection = "mysql";

    public $table = "audit_temuan";

    public $primary_key = "id";

    
	public $id;
	public $audit_id;
	public $created_by;
	public $cms_users_id;
	public $type;
	public $referensi;
	public $pernyataan;
	public $file;
	public $created_at;
	public $updated_at;

}