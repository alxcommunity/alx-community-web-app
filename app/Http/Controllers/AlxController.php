<?php

namespace App\Http\Controllers;

use App\Models\Alx;
use Illuminate\Http\Request;
use GuzzleHttp\Client as client;
use Illuminate\Support\Facades\Http;

class AlxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = Http::dd()->withOptions(['verify' => false])->post('https://alx-intranet.hbtn.io/users/me.json', [
            'api_key' => $request->api_key,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return $req;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alx  $alx
     * @return \Illuminate\Http\Response
     */
    public function show(Alx $alx)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alx  $alx
     * @return \Illuminate\Http\Response
     */
    public function edit(Alx $alx)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alx  $alx
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alx $alx)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alx  $alx
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alx $alx)
    {
        //
    }
}
