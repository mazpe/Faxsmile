<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index() {

//        $client = App\Client::class;
//
//        if (Auth::user()->isSuperAdmin() || Auth::user()->isCompanyAdmin() || Auth::user()->isClientAdmin()) {
//            $client = Auth::user()->client;
//        }

        return view('admin.admin_template')
            ->with('page_title','Admin')
//            ->with('client', $client)
            ;
    }


}
