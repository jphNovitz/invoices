<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\client;


class ApiClientController extends Controller
{
    public function show($id){
//        $client = Client::find($id);
//        Client::with('city')->get()->toJson()
//        return $client->toJson();
//        $client = Client::with('city')->findOrFail($id);

        return Client::with('city')->findOrFail($id)->toJson();
    }
}
