<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;


class ClientsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $request->flash();

      $inputsArray = [
        'clients.name'   => [ 'like', request('name') ],
        'clients.phone'   => [ 'like', request('phone') ],
        'clients.email'   => [ 'like', request('email') ],
        'clients.status'              => [ '=', request('status') ]
      ];

      $query = Client::latest();

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $clients = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.clients.index', compact('clients'));
    }


    /**
     * Goto the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.clients.create');
    }


    /**
     * Store a newly created client.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {

        $client = Client::create($request->all());

        $client->status = $request->status;
        $client->save();

        return redirect()->route('admin.clients.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        return view('dashboard.clients.show', compact('client'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
      return view('dashboard.clients.edit', compact('client'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());

        $client->status = $request->status;
        $client->save();

        return redirect()->route('admin.clients.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the client
     */
    public function destroy(Client $client)
    {
        // Get Image name
        $media = $client->media;

        // Delete Record
        $client->delete();

        // Delete Image
        $this->deleteFile('clients/', $media);


      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
