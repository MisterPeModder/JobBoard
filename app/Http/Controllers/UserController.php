<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();

        return view('user.index', ['users' => $users]);
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
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //user is trying to access other one's data, access denied
        if (Auth::user() != $user) {
            abort(404);
        }
        Log::info("Updating User #$user->id data");
        //validate data with rules
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)], // email must not be alrealy used, expect self
            'phone_number' => ['nullable', 'string'],
        ]);
        //updating data
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save(); //saving it

        return redirect()->route('users.show', $user);
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

        return redirect()->route('/');
    }

    /**
     * Check if current logged user is admin
     *
     * @return bool
     */
    public function is_admin()
    {
        return Auth::user()->is_admin == 1 ? true : false;
    }

    /**
     * Display changing password page
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('users/change-password');
    }

    /**
     * Change the password by the new one
     *
     * @param  Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        //user is trying to access other one's data, access denied
        if (Auth::user() != $user) {
            abort(404);
        }

        $request->validate([
            'oldpassword' => ['required'],
            'newpassword' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // if old password hash is not the same as current one, error
        if (! Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => __('Old password does not match')]);
        }

        $user->forceFill([
            'password' => Hash::make($request->newpassword),
            'remember_token' => Str::random(60),
        ])->save();

        Log::info("Updating User #$user->id password");

        return redirect()->route('users.show', $user);
    }
}
