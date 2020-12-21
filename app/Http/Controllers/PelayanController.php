<?php

namespace App\Http\Controllers;

use App\Pelayan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @method validationMessages()
 */
class PelayanController extends Controller
{

    public function signUp(){

    }

    public function signIn(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $rules = [
            'email' => 'required|email:rfc,dns|max:255',
            'password' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules, $this->validationMessages());

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 400);
        }

        if (pelayan::where('email', $email)->count() <= 0) return response(array("message" => "Email number does not exist"), 400);

        $customer = pelayan::where('email', $email)->first();

        if (password_verify($password, $customer->password)) {
            $customer->last_login = Carbon::now();
            $customer->save();
            return response(array("message" => "Sign In Successful", "data" => [
                "customer" => $customer,

                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
                "token" => $customer->createToken('Personal Access Token', ['customer'])->accessToken
            ]), 200);
        } else {
            return response(array("message" => "Wrong Credentials."), 400);
        }
    }

    public function dashboard(Request $request){
            $pelayan = $request->user();
    }

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
        //
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
}
