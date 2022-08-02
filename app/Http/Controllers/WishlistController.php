<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistCreateRequest;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WishlistResource::collection(

            Wishlist::whereBelongsTo(Auth::user())
                ->get()

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WishlistCreateRequest $request)
    {
        $formField = $request->validated();


        $wishlist = Wishlist::create([
            'product_id' => $formField['product_id'],
            'user_id' =>   Auth::user()['id'],
        ]);

        $response = [
            'message' => 'Wishlist created successfully',
            'created' => new WishlistResource($wishlist),
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        return new WishlistResource($wishlist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::user()['id'];
        $conditions = array('user_id' => $userId, 'product_id' => $id);
        return Wishlist::whereArray($conditions)->delete();
    }
}
