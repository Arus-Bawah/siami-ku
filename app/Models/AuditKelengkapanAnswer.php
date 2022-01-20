<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class AuditKelengkapanAnswer extends Model
{
    public $connection = "mysql";

    public $table = "audit_kelengkapan_answer";

    public $primary_key = "id";


	public $id;
	public $audit_kelengkapan;
	public $keterangan;
	public $file;
	public $question_id;
	public $action;
	public $created_at;
	public $updated_at;

}
