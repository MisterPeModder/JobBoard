<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //user is trying to access other one's data, access denied
        if (Auth::user() != $user) {
            abort(404);
        }
        Log::info("Showing User #$user->id data");

        //return profile page with user's data
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //user is trying to access other one's data, access denied
        if (Auth::user() != $user) {
            abort(404);
        }
        Log::info("Showing User #$user->id editing form");
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        echo $request->name;
        
        //user is trying to access other one's data, access denied
        if (Auth::user() != $user) {
            abort(404);
        }
        Log::info("Updating User #$user->id data");
        $user->update($request->validated());

        

        return redirect()->route('users.show')->withSuccess(__('User updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //user is trying to access other one's data, access denied
        if (Auth::user() != $user) {
            abort(404);
        }

        $user->delete();
    }
}
