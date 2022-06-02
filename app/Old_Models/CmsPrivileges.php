<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class CmsPrivileges extends Model
{
    public $connection = "mysql";

    public $table = "cms_privileges";

    public $primary_key = "id";

    
	public $id;
	public $created_at;
	public $updated_at;
	public $name;
	public $is_superadmin;

}