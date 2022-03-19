<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class AuditPerbaikan extends Model
{
    public $connection = "mysql";

    public $table = "audit_perbaikan";

    public $primary_key = "id";

    
	public $id;
	public $audit_id;
	public $created_by;
	public $cms_users_id;
	public $area;
	public $recomended;
	public $pic;
	public $target;
	public $created_at;
	public $updated_at;

}