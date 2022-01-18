<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class MasterTemplateCategory extends Model
{
    public $connection = "mysql";

    public $table = "master_template_category";

    public $primary_key = "id";

    
	public $id;
	public $master_template;
	public $main_category;
	public $category;
	public $ordering;
	public $created_at;
	public $updated_at;

}