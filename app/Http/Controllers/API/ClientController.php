<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Client;

class ClientController extends Controller
{
    public function users($id) {
        $client = Client::find($id);
        $users = $client->users()->get();
        return $users;
    }
}
