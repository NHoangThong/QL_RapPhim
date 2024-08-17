<?php

namespace App\Http\Controllers;

use App\Models\Ve;
use Illuminate\Http\Request;

class VeController extends Controller
{
    //

    public function ticket()
    {
        $ticket = Ve::orderBy('id_ve', 'DESC')->Paginate(10);
        return view('admin.ve.list',['ticket'=>$ticket]);
    }
}
