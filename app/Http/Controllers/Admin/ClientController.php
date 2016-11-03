<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\Company;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('index', Client::class);

        return view('admin.client.index',[
            'clients' => Client::withCount('users','faxes')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Client::class);

        $companies = Company::Pluck('name', 'id');

        if (Auth::user()->isClientAdmin())
        {
            $parent_id = Auth::user()->parent_id;
        }
        else if (Auth::user()->isCompanyAdmin())
        {
            $parent_id = Auth::user()->id;
        }

        return view('admin.client.create', compact('companies', 'parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('store', Client::class);

        $this->validate($request, [
            'parent_id' => 'required|numeric',
            'name' => 'required|unique:entities,name,NULL,id,deleted_at,NULL'
        ]);

        Client::create($request->all());

        return redirect()->route('client.index')
            ->with('success','Client created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $client = Client::with('users','faxes','emailConfigs')->find($id);

        $this->authorize('view', $client);

        return view('admin.client.show',
            compact('client')
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
        $client = Client::find($id);

        $this->authorize('update', $client);

        $companies = Company::Pluck('name', 'id');

        return view('admin.client.edit',compact('client','companies'));
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
        $client = Client::find($id);

        $this->authorize('update', $client);

        $this->validate($request, [
            'parent_id' => 'required|numeric',
            'name' => 'required|max:255',
        ]);

        $client->update($request->all());

        return redirect()->route('client.show', ['client_id' => $client->id])
            ->with('success','Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $this->authorize('delete', $client);

        $client->delete();
        return redirect()->route('client.index')
            ->with('success','Client deleted successfully');
    }
}
