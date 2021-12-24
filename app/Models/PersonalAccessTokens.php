<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class PersonalAccessTokens extends Model
{
    public $connection = "mysql";

    public $table = "personal_access_tokens";

    public $primary_key = "id";

    
	public $id;
	public $tokenable_type;
	public $tokenable_id;
	public $name;
	public $token;
	public $abilities;
	public $last_used_at;
	public $created_at;
	public $updated_at;

}