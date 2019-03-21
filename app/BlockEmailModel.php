<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockEmailModel extends Model
{
    protected $table = 'block_emails';
    protected $fillable = ['email'];
}
