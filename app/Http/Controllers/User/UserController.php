<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('User.index', ['user' => $user]);
    }

    public function update()
    {
        $user = auth()->user();
        $cities = \App\Models\City::all();
        return view('User.update-user', [
            'user' => $user,
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $user = auth()->user();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->company = $data['company'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->street = $data['street'];
        $user->nr = $data['nr'];
        $user->city_id = $data['city_id'];
        $user->vat = $data['vat'];
        $user->phone = $data['phone'];

        if ($user->save()) {
            return redirect()->route('user_home')->with('success', 'Votre profil est modifié');
        }
    }

    public function delete()
    {
        $user = auth()->user();
        return view('User.user-delete', ['user' => $user]);
    }

    public function remove(Request $request)
    {
        $user = \Auth::user();
        if (!$user) {
            return redirect()->route('user')->with('error', 'Connectez vous !');
        }

        if ($request->_decline) return redirect(route('user_home'))->with('message', 'annulé');


        try {
            $user->delete();
            $message = 'Compte supprimée';
        } catch (\Exception $e) {
            $message = 'Erreur dans la suppression';
        }
        return redirect()->route('user_home')->with('message', $message);
    }

}
