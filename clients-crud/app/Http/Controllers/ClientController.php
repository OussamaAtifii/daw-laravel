<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->paginate(7);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'unique:clients,username'],
            'email' => ['required', 'email', 'unique:clients,email'],
            'descripcion' => ['required', 'string', 'min:10']
        ]);

        Client::create([
            'username' => $request->username,
            'email' => $request->email,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('clients.index')->with('success_msg', 'El cliente se creó con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.update', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'unique:clients,username,' . $client->id],
            'email' => ['required', 'email', 'unique:clients,email,' . $client->id],
            'descripcion' => ['required', 'string', 'min:10']
        ]);

        $client->update([
            'username' => $request->username,
            'email' => $request->email,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('clients.index')->with('success_msg', 'El cliente se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success_msg', 'El cliente se eliminó con éxito');
    }
}
