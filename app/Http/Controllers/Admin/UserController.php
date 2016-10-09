<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Recipient;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Fax;
use App\Sender;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::with('entity')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $clients = Client::Pluck('name', 'id');
        $faxes = Fax::Pluck('number', 'id');

        return view('admin.user.create', compact('clients', 'faxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('store', User::class);

        $this->validate($request, [
            'entity_id' => 'required|numeric',
            'email' => 'required|unique:users|email',
        ]);

        User::create($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        $this->authorize('view', $user);

        $user->with('entity');
        $recipient = Recipient::find($user->id);

        return view('admin.user.show',
            compact('user', 'recipient')
        );
    }

    /**
     * Display the specified resource to be edited.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $clients = Client::Pluck('name', 'id');
        $faxes = Fax::Pluck('number', 'id');

        return view('admin.user.edit', compact('user', 'clients', 'faxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'entity_id' => 'required|numeric',
            'email' => 'required|email'
        ]);

        $user = User::find($id)->update($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
