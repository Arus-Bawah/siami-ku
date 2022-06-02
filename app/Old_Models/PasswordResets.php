<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class PasswordResets extends Model
{
    public $connection = "mysql";

    public $table = "password_resets";

    public $primary_key = "";

    
	public $email;
	public $token;
	public $created_at;

}