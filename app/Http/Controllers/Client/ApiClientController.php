<?php

namespace App\Http\Controllers\Client;

use App\client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
