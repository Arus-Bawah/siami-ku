<?php
namespace App\Models;

use crocodicstudio\cbmodel\Core\Model;

class FailedJobs extends Model
{
    public $connection = "mysql";

    public $table = "failed_jobs";

    public $primary_key = "id";


	public $id;
	public $uuid;
	public $queue;
	public $payload;
	public $exception;
	public $failed_at;

}
