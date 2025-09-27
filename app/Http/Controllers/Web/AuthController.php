<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        return view('auth.login');
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        return view('auth.register');
    }

    /**
     * Procesar login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        try {
            // Intentar autenticación con JWT
            if (!$token = JWTAuth::attempt($credentials)) {
                return redirect()->back()
                    ->withErrors(['email' => 'Credenciales inválidas'])
                    ->withInput($request->except('password'));
            }

            $user = Auth::user();

            // Guardar token en sesión y cookie
            session(['jwt_token' => $token]);
            $cookie = cookie('jwt_token', $token, 60); // 1 hora

            return redirect()->intended(route('home'))
                ->with('success', '¡Bienvenido de vuelta!')
                ->withCookie($cookie);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['email' => 'Error al iniciar sesión'])
                ->withInput($request->except('password'));
        }
    }

    /**
     * Procesar registro
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'is_active' => true,
            ]);

            // Generar token JWT
            $token = JWTAuth::fromUser($user);

            // Autenticar al usuario
            Auth::login($user);

            // Guardar token en sesión y cookie
            session(['jwt_token' => $token]);
            $cookie = cookie('jwt_token', $token, 60); // 1 hora

            return redirect()->route('home')
                ->with('success', '¡Cuenta creada exitosamente!')
                ->withCookie($cookie);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['email' => 'Error al crear la cuenta'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        try {
            $token = session('jwt_token');
            
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }
        } catch (\Exception $e) {
            // Ignorar errores al invalidar token
        }

        // Limpiar sesión y autenticación
        Auth::logout();
        session()->forget('jwt_token');
        
        $cookie = cookie()->forget('jwt_token');

        return redirect()->route('home')
            ->with('success', 'Sesión cerrada exitosamente')
            ->withCookie($cookie);
    }

    /**
     * Perfil del usuario
     */
    public function profile()
    {
        $user = Auth::user();
        
        return view('auth.profile', compact('user'));
    }

    /**
     * Actualizar perfil
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user->update($request->only(['name', 'last_name', 'email', 'phone']));

            return redirect()->back()
                ->with('success', 'Perfil actualizado exitosamente');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['email' => 'Error al actualizar el perfil']);
        }
    }
}
