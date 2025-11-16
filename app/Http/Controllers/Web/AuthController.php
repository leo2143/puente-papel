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
        // Usar validate() en vez de Validator::make()
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);

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
                ->with('feedback.message', '¡Bienvenido de vuelta!')
                ->with('feedback.type', 'success')
                ->withCookie($cookie);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('feedback.message', 'Error al iniciar sesión. Verifica tus credenciales.')
                ->with('feedback.type', 'danger');
        }
    }

    /**
     * Procesar registro
     */
    public function register(Request $request)
    {
        // Usar validate() en vez de Validator::make()
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

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

            return to_route('home')
                ->with('feedback.message', '¡Cuenta creada exitosamente!')
                ->with('feedback.type', 'success')
                ->withCookie($cookie);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('feedback.message', 'Error al crear la cuenta. Intenta nuevamente.')
                ->with('feedback.type', 'danger');
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
        
        // IMPORTANTE: Invalidar sesión y regenerar token CSRF (seguridad)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        session()->forget('jwt_token');
        $cookie = cookie()->forget('jwt_token');

        return to_route('home')
            ->with('feedback.message', 'Sesión cerrada exitosamente')
            ->with('feedback.type', 'success')
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
