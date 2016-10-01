<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fax;
use App\User;
use App\Provider;

class FaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.fax.index',[
            'faxes' => Fax::with('provider')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $providers = Provider::Pluck('name', 'id');
        $users = User::all()->pluck('full_name','id');
        return view('admin.fax.create', compact('providers','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $this->validate($request, [
            'provider_id' => 'required|numeric',
            'number' => 'required|unique:faxes|numeric',
        ]);

        Fax::create($request->all());

        return redirect()->route('fax.index')
            ->with('success','Fax created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $fax = Fax::with('provider')->find($id);
//        $fax_users = $fax->users;
        return view('admin.fax.show',
            compact('fax','fax_users')
        );
    }

    /**
     * Display the specified resource to be edited.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $fax = Fax::find($id);
        $providers = Provider::Pluck('name', 'id');
        $users = User::All();
        $users = $users->pluck('FullName', 'id');

        return view('admin.fax.edit', compact('fax','providers','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'provider_id' => 'required|numeric',
            'number' => 'required|numeric',
        ]);

        Fax::find($id)->update($request->all());

        return redirect()->route('fax.index')
            ->with('success','Fax updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Fax::find($id)->delete();
        return redirect()->route('fax.index')
            ->with('success','Fax deleted successfully');
    }
}
