<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class CmsPrivilegesRoles extends Model
{
    public $connection = "mysql";

    public $table = "cms_privileges_roles";

    public $primary_key = "id";

    
	public $id;
	public $created_at;
	public $updated_at;
	public $id_cms_privileges;
	public $id_cms_menus;
	public $can_view;
	public $can_add;
	public $can_edit;
	public $can_delete;

}