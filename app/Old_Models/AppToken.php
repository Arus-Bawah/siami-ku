<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class AppToken extends Model
{
    public $connection = "mysql";

    public $table = "app_token";

    public $primary_key = "id";

    
	public $id;
	public $created_at;
	public $expired_at;
	public $ip;
	public $users_agent;
	public $token;
	public $id_users;
	public $role;

}