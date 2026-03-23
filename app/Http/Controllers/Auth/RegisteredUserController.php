<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $isEmail = filter_var($request->login_id, FILTER_VALIDATE_EMAIL);

        $request->validate([
            'first_name'  => ['required', 'string', 'max:255'],
            'last_name'   => ['required', 'string', 'max:255'],
            'login_id'    => [
                'required', 'string', 'max:255',
                $isEmail
                    ? \Illuminate\Validation\Rule::unique('users', 'email')
                    : \Illuminate\Validation\Rule::unique('users', 'phone'),
            ],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_month' => ['nullable', 'integer', 'min:1', 'max:12'],
            'birth_day'   => ['nullable', 'integer', 'min:1', 'max:31'],
            'birth_year'  => ['nullable', 'integer', 'min:1900', 'max:'.date('Y')],
            'gender'      => ['nullable', 'string', 'in:male,female,other'],
        ]);

        $user = User::create([
            'name'        => $request->first_name . ' ' . $request->last_name,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'email'       => $isEmail ? strtolower($request->login_id) : null,
            'phone'       => $isEmail ? null : $request->login_id,
            'password'    => Hash::make($request->password),
            'birth_month' => $request->birth_month,
            'birth_day'   => $request->birth_day,
            'birth_year'  => $request->birth_year,
            'gender'      => $request->gender,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
