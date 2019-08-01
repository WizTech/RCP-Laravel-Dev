<?php

namespace App\student;

use Illuminate\Foundation\Auth\User as Authenticatable;


class StudentLogin extends Authenticatable
{
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $fillable = ['email', 'name', 'password'];
  protected $guard = 'users';
  public function getAuthPassword()
  {
    return $this->password;
  }
}