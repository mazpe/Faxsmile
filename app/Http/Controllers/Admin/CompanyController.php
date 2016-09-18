<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Show companies
     *
     * @return Response
     */
    public function index() {
        $page_title = 'Company';
        return view('admin.company.index',[
            'page_title' => 'Companies',
            'companies' => Company::all()
        ]);
    }

    /**
     * Show the form to create a new company
     *
     * @return Response
     */
    public function create() {
        return view('admin.company.create',[
            'page_title' => 'Companies',
            'companies' => Company::all()
        ]);
    }

    /**
     * Store a new company
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required|unique:companies|max:255',
        ]);

    }
}
