<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Card::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Card::add($request->input('name'), $request->input('urlPicture'), $request->input('set_id'),$request->input('content'), $request->input('cost'))) {
            return response()->json([
                'success' => true,
                'message' => 'La carte a bien été enregistrée'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'La carte n\'a pas été enregistrée'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $card = Card::search($request->input('name'));
        if ($card) {
            return response()->json([
                'success' => true,
                'data' => $card
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cette carte n\'existe pas'
            ], 404);
        }
    }
}
