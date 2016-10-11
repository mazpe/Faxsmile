<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fax;
use App\User;
use App\Client;
use App\Provider;
use App\Sender;
use App\Recipient;

class FaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('index', Fax::class);

        if (Auth::user()->isSuperAdmin()) {
            $faxes = Fax::with('provider')->withCount('senders','recipients')->get();
        }
        else if (Auth::user()->isProviderAdmin()) {
            $faxes = Auth::user()->provider->faxes;
        }
        else if (Auth::user()->isCompanyAdmin()) {
            $faxes = Auth::user()->company->faxes;
        }
        else if (Auth::user()->isClientAdmin())
        {
            $faxes = Auth::user()->client->faxes;
        }

        return view('admin.fax.index',[
            'faxes' =>  $faxes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Fax::class);

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
    public function store(Request $request)
    {
        $this->authorize('store', Fax::class);

        $input = $request->input;
        $v = Validator::make($request->all(), [
            'provider_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'number' => 'required|unique:faxes,number,NULL,id,deleted_at,NULL'
        ]);
        $v->sometimes('recipients', 'required', function($input) {
            return !(Auth::user()->isSuperAdmin() ||  Auth::user()->isCompanyAdmin());
        });
        $v->validate();

        $fax = Fax::create($request->all());

        // create || attach senders
        if ($request->input('senders')) {
            // Convert list into array by , or ;
            // TODO: Verify that list is in correct format before processing.
            $senders = preg_split( "/[,;]/", $request->input('senders'));

            // Attach each recipient in the list seperated by , or ; to the created fax
            foreach($senders as $sender_email) {
                $sender_email = trim($sender_email);
                $sender = Sender::where('email', $sender_email);

                if ($sender->exists()) {
                    $sender = $sender->first();
                } else {
                    // create user
                    $sender = Sender::create([
                        'entity_id' => $request->input('client_id'),
                        'email' => $sender_email,
                        'password' => str_random(6),
                        'remember_token' => str_random(10),
                        'active' => 1
                    ]);
                }

                if ($sender) {
                    $sender->update(['fax_id' => $fax->id]);
                } else {
                    // TODO: some kind of error
                }
            }
        }

        // create || attach recipients
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

        return redirect()->route('fax.edit', ['fax_id' => $fax->id])
            ->with('success','Fax deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $fax = Fax::find($id);
        $this->authorize('view', $fax);

        $clients = Client::all();
        $fax->with('provider');

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

        $this->authorize('update', $fax);

        $providers = Provider::Pluck('name', 'id');
        $clients = Client::pluck('name', 'id');

        // create a mailing list style of recipients (email@email.com, user@aol.com)
        $senders = $fax->senders->implode('email', ', ');
        // create a mailing list style of recipients (email@email.com, user@aol.com)
        $recipients = $fax->recipients->implode('email', ', ');

        return view('admin.fax.edit', compact('fax','providers','clients','senders','recipients'));
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
        $fax = Fax::find($id);

        $this->authorize('update', $fax);

        $this->validate($request, [
            'provider_id' => 'required|numeric',
            'number' => 'required|numeric',
        ]);

        $fax->update($request->all());

        $recipients_ids = array();

        // TODO: this logic should probably be moved to owns function as its been reused by create and edit

        // create || attach senders
        if ($request->input('senders')) {
            // Convert list into array by , or ;
            // TODO: Verify that list is in correct format before processing.
            $senders = preg_split( "/[,;]/", $request->input('senders'));

            // Attach each recipient in the list seperated by , or ; to the created fax
            foreach($senders as $sender_email) {
                $sender_email = trim($sender_email);
                $sender = Sender::where('email', $sender_email);

                if ($sender->exists()) {
                    $sender = $sender->first();
                } else {
                    // create user
                    $sender = Sender::create([
                        'entity_id' => $request->input('client_id'),
                        'email' => $sender_email,
                        'password' => str_random(6),
                        'remember_token' => str_random(10),
                        'active' => 1
                    ]);
                }

                if ($sender) {
                    $sender->update(['fax_id' => $fax->id]);
                } else {
                    // TODO: some kind of error
                }
            }
        }

        // Check each recipient if its created and if its not create it and create an array with ids
        // this array of ids is going to be used to sync the fax_recipients table
        if (!empty($request->input('recipients'))) {
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

        if (!empty($recipient)) {
            $fax->recipients()->syncWithoutDetaching($recipients_ids);
        } else {
            // TODO: some kind of error
        }

        return redirect()->route('fax.edit', ['fax_id' => $fax->id])
            ->with('success','Fax deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('delete', Fax::class);

        $fax = Fax::find($id);

        $fax->recipients()->detach();
        $fax->senders()->update(['fax_id' => null]);
        $fax->delete();

        return redirect()->route('fax.index')
            ->with('success','Fax deleted successfully');
    }

}
