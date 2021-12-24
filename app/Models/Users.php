<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class Users extends Model
{
    public $connection = "mysql";

    public $table = "users";

    public $primary_key = "id";

    
	public $id;
	public $name;
	public $email;
	public $email_verified_at;
	public $password;
	public $username;
	public $remember_token;
	public $created_at;
	public $updated_at;
	public $photo;
	public $signature;
	public $position;
	public $unit;

}