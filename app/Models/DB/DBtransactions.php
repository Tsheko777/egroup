<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class DBtransactions extends Model
{
    protected $table = "tbl_transactions";
    protected $guarded = ['id'];
}
