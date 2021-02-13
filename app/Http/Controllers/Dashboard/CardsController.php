<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;

class CardsController extends Controller
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
        'cards.full_name'   => [ 'like', request('name') ],
        'cards.phone'   => [ 'like', request('phone') ],
        'cards.email'   => [ 'like', request('email') ],
        'cards.status'              => [ '=', request('status') ]
      ];

      $query = Card::latest();

      $searchQuery = $this->handleSearch($query, $inputsArray);

      $cards = $searchQuery->paginate(config('my-config.perPage'));

      return view('dashboard.cards.index', compact('cards'));
    }


    /**
     * Goto the form for creating a new card.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.cards.create');
    }


    /**
     * Store a newly created card.
     *
     * @param  \App\Modules\Admin\Http\Requests\CardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardRequest $request)
    {
        $card = Card::create($request->all());

        return redirect()->route('admin.cards.index')->with('msg_success', __('dashboard.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Card $card)
    {
        return view('dashboard.cards.show', compact('card'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
      return view('dashboard.cards.edit', compact('card'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\CardRequest  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(CardRequest $request, Card $card)
    {
        $card->update($request->all());

        return redirect()->route('admin.cards.index')->with('msg_success', __('dashboard.updatedSuccessfully'));
    }

    /**
     * Delete the card
     */
    public function destroy(Card $card)
    {
        // Get Image name
        $avatar = $card->avatar;

        // Delete Record
        $card->delete();

        // Delete Image
        $this->deleteFile('cards/', $avatar);


      return back()->with('msg_success', __('dashboard.deletedSuccessfully'));
    }

}
