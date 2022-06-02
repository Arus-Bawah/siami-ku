<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class CmsMenus extends Model
{
    public $connection = "mysql";

    public $table = "cms_menus";

    public $primary_key = "id";

    
	public $id;
	public $created_at;
	public $updated_at;
	public $name;
	public $icon;
	public $path;
	public $parent_id;
	public $sorting;

}