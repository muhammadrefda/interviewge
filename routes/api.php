<?php

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'AuthController@login');


Route::middleware(['auth:api', 'role'])->group(function() {

    // List daftar pesanan yang aktif
    Route::middleware(['scope:pelayan,kasir'])->get('/orders', function (Request $request) {

        return \App\Order::get();
    });

    //pelayan melihay aktifitas pesanan
    Route::middleware(['scope:Pelayan'])->post('/pelayan/report', function(Request $request) {
        return \App\Order::create($request->all());
    });

    //
    Route::middleware(['scope:kasir'])->put('active/order/{orderId}', function(Request $request, $orderId) {

        try {
            $activeOrder = \App\Order::findOrFail($orderId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Order not found.'
            ], 403);
        }

        $activeOrder->update($request->all());

        return response()->json(['message'=>'Order status has been update!']);
    });
});

