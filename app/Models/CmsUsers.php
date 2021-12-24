<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class CmsUsers extends Model
{
    public $connection = "mysql";

    public $table = "cms_users";

    public $primary_key = "id";


	public $id;
	public $created_at;
	public $updated_at;
	public $name;
	public $email;
	public $foto;
	public $password;
	public $username;
	public $id_cms_privileges;
	public $status;
	public $photo;
	public $signature;
	public $position;
	public $unit;

    /**
     * @return Model
     */
    public function cmsPrivileges(): Model
    {
        return CmsPrivileges::find($this->id_cms_privileges);
    }
}
