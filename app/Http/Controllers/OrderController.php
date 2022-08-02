<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(
            Order::whereBelongsTo(Auth::user())
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request)
    {

        $formField = $request->validated();

        $totalAmount = 0;
        
        // get the price of products of product_id using whereIn
        // $products = Product::whereIn('id',[1,2])->get()->pluck('price');
        $products =  DB::table('products')
            ->select('price')
            ->whereIn('id', $formField['product_id'])
            ->get();


        foreach ($products as $product) {
            $totalAmount += $product->price;
        }

        // var_dump($totalAmount);
        // exit;

       
        $order = Order::create([
            'product_id' => $formField['product_id'],
            'user_id' => Auth::id(),
            'total' => $totalAmount,
            'status' => false,
        ]);


        $response = [
            'message' => 'order placed',
            'created' => new OrderResource($order),
        ];

        return response($response, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $Order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $userId = Auth::user()['id'];
        $conditions = array('user_id' => $userId, 'id' => $order);
        return Order::whereArray($conditions)->delete();
    }
}
