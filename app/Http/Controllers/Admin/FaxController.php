<?php

namespace App\Http\Controllers\Admin;

use App\Recipient;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fax;
use App\User;
use App\Client;
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
        $clients = Client::pluck('name','id');
        $users = User::all()->pluck('full_name','id');
        return view('admin.fax.create', compact('providers','clients','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $input = $request->input;
        $v = Validator::make($request->all(), [
            'provider_id' => 'required|numeric',
            'recipients' => 'required',
            'number' => 'required|unique:faxes,number,NULL,id,deleted_at,NULL'
        ]);
        $v->sometimes('client_id', 'required|numeric', function($input) {
            return !empty($input['recipients']);
        });
        $v->validate();

        $fax = Fax::create($request->all());

        if ($request->input('recipients')) {
            // Convert list into array by , or ;
            // TODO: Verify that list is in correct format before processing.
            $recipients = preg_split( "/[,;]/", $request->input('recipients'));

            // Attach each recipient in the list seperated by , or ; to the created fax
            foreach($recipients as $recipient_email) {
                $recipient_email = trim($recipient_email);
                $recipient = Recipient::where('email', $recipient_email);

                if ($recipient->exists()) {
                    $recipient = $recipient->first();
                } else {
                    // create user
                    $recipient = Recipient::create([
                        'entity_id' => $request->input('client_id'),
                        'email' => $recipient_email,
                        'password' => str_random(6),
                        'remember_token' => str_random(10),
                        'active' => 1
                    ]);
                }

                if ($recipient) {
                    $fax->recipients()->attach($recipient->id);
                } else {
                    // TODO: some kind of error
                }
            }
        }

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
        $clients = Client::all();
        $fax = Fax::with('provider')->find($id);


        return view('admin.fax.show',
            compact('fax','clients')
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

        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::pluck('name', 'id');

        // create a mailing list style of recipients (email@email.com, user@aol.com)
        $recipients = $fax->recipients->implode('email', ', ');

        return view('admin.fax.edit', compact('fax','providers','clients','users','recipients'));
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

        $fax = Fax::find($id);
        $fax->update($request->all());

        $recipients_ids = array();

        // TODO: this logic should probably be moved to owns function as its been reused by create and edit
        // Check each recipient if its created and if its not create it and create an array with ids
        // this array of ids is going to be used to sync the fax_recipients table
        if ($request->input('recipients')) {
            // Convert list into array by , or ;
            // TODO: Verify that list is in correct format before processing.
            $recipients = preg_split( "/[,;]/", $request->input('recipients'));

            // Attach each recipient in the list seperated by , or ; to the created fax
            foreach($recipients as $recipient_email) {
                $recipient_email = trim($recipient_email);
                $recipient = Recipient::where('email', $recipient_email);

                if ($recipient->exists()) {
                    $recipient = $recipient->first();
                } else {
                    // create user
                    $recipient = Recipient::create([
                        'entity_id' => $request->input('client_id'),
                        'email' => $recipient_email,
                        'password' => str_random(6),
                        'remember_token' => str_random(10),
                        'active' => 1
                    ]);
                }

                array_push($recipients_ids, $recipient->id);
            }
        }

        if ($recipient) {
            $fax->recipients()->sync($recipients_ids);
//            $fax->recipients()->sync([1,2,3]);
        } else {
            // TODO: some kind of error
        }




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
