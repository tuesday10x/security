<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Requests\PostTestRequest;

class HomeController extends Controller
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
        return view('home');
    }

    public function post_test(PostTestRequest $request)
    {
        $user = auth()->user();
        // $user->fill($request->all()); // ! Update all the things

        // $user->fill($request->only([
        //     'name',
        //     'role',
        // ]));

        $user->fill([
            'name' => clean($request->name),
        ]);

        $user->save();

        return back();
    }

    public function secret(Request $request)
    {
        $request->validate([
            'secret' => 'required',
        ]);

        $user = auth()->user();
        $user->secret = encrypt($request->secret);
        $user->save();

        return back();
    }
}
