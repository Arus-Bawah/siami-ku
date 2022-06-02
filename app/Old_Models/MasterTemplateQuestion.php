<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class MasterTemplateQuestion extends Model
{
    public $connection = "mysql";

    public $table = "master_template_question";

    public $primary_key = "id";

    
	public $id;
	public $master_template_category;
	public $ordering;
	public $question;
	public $keterangan;
	public $capaian;
	public $type_answer;
	public $created_at;
	public $updated_at;

}