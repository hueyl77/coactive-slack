<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use SoftDeletes;
    protected $table = 'lantern_accounts';
}
