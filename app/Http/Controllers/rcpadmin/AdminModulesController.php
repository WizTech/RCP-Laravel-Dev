<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\AdminModules;

class AdminModulesController extends Controller
{
    //
    public function index()
    {

        $modules = new AdminModules();

        $data = $modules->all()->toArray();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
