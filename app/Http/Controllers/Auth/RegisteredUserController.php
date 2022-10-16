<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $MAX_ICON_SIZE = 4000;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'phone-number' => ['string', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'icon' => 'nullable|file|mimes:jpg,png,webp,pdf|max:'.$MAX_ICON_SIZE,
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone-number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // creating icon
        if ($request->hasFile('icon')) {
            $icon = Asset::factory()
                ->public()
                ->storeFile($request->file('icon'), "$user->id")
                ->create();

            $user->icon_id = $icon->id;
            $user->icon()->save($icon);

            $icon->user()->associate($user);
            $icon->save();
            Log::info("Created icon (#$icon->id) of user #$user->id");
        }

        event(new Registered($user));

        Auth::login($user);

        Log::info("User (#$user->id) created");

        return view('auth.verify-email');
    }
}
