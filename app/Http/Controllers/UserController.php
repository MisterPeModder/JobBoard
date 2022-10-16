<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    const USERS_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $this->authorize('viewAny', User::class);

        $users = User::with('icon.blob')->paginate(self::USERS_PER_PAGE);
        $currentPage = $request->query('page', '1');

        if ($currentPage < 1 || $currentPage > $users->lastPage()) {
            return redirect($request->fullUrlWithoutQuery('page'));
        }

        return response()->view('users.list', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        //return profile page with user's data
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', [
            'user' => $user,
            'admin' => self::adminModeRequired($request),
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
        $this->authorize('update', $user);

        $MAX_ICON_SIZE = 4000;
        Log::info("Updating User #$user->id data");

        //validate data with rules
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)], // email must not be alrealy used, expect self
            'phone_number' => ['nullable', 'string'],
            'icon' => 'nullable|file|mimes:jpg,png,webp,pdf|max:'.$MAX_ICON_SIZE,
        ]);

        DB::transaction(function () use ($user, $request) {
            //updating data
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;

            // updating icon
            if ($request->hasFile('icon') && $user->can('create', Asset::class)) {
                $oldIcon = $user->icon;
                if ($oldIcon !== null) {
                    $user->icon()->delete();
                }

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

            $user->save(); //saving it
            Log::info("User (#$user->id) updated");
        });

        if (self::adminModeRequired($request)) {
            return redirect()->route('users.edit', ['user' => $user, 'admin' => '1']);
        } else {
            return redirect()->route('users.show', $user);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $isAdmin = Auth::user()->is_admin;

        $id = $user->id;
        $user->delete();
        Log::info("Deleted user #$id");

        if ($isAdmin) {
            return redirect()->route('users.index');
        } else {
            return redirect('/');
        }
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
        $this->authorize('update', $user);

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

    /**
     * @param  Illuminate\Http\Request  $request
     */
    private static function adminModeRequired(Request $request): bool
    {
        $user = $request->user();

        return $user?->is_admin && $request->boolean('admin');
    }
}
