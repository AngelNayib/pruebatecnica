<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    /**
     * Login Web
     *     @param  \Illuminate\Http\Request  $request
     *     @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            Auth::login($user = User::where('email', $request->email)->first());
            $request->session()->regenerate();
            return redirect()->route('producto.index');
        } else {
            return redirect()->route('login')->with('errors', 'Credenciales incorrectas');
        }
    }

    /**
     * Login API
     *     @param  \Illuminate\Http\Request  $request
     *     @return \Illuminate\Http\Response
     */
    public function loginApi(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Buscar al usuario por su email
        $user = User::where('email', $loginUserData['email'])->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return responseJson(401, 'Unauthorized', 'Unauthorized');
        }

        // Crear un token de acceso para el usuario autenticado
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return responseJson(200, 'ok', $token);
    }

    /**
     * Logout Web
     *     @param  \Illuminate\Http\Request  $request
     *     @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Register Web
     *     @param  \Illuminate\Http\Request  $request
     *     @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            };
            DB::beginTransaction();
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Usuario creado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('register')->with('errors', $e->getMessage());
        }
    }
}
