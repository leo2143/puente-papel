<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Listar usuarios
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtro de búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro de rol
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user){
        $user->load(['orders.orderItems.product']);

        $totalPurchases = $user->orders->count();
        $totalSpent = $user->orders->sum('total_amount');

        return view('admin.users.show', compact('user', 'totalPurchases', 'totalSpent'));
    }

        /**
         * Mostrar formulario de creación
         */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Crear nuevo usuario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'El rol es obligatorio.',
        ]);

        // Usar only() para obtener solo los campos que necesitamos (whitelisting)
        $data = $request->only(['name', 'last_name', 'email', 'phone', 'role', 'is_active']);
        $data['password'] = Hash::make($validated['password']);
        $data['is_active'] = $validated['is_active'] ?? true;

        User::create($data);

        return to_route('admin.users.index')
            ->with('feedback.message', 'Usuario creado exitosamente')
            ->with('feedback.type', 'success');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'El rol es obligatorio.',
        ]);

        // Usar only() para obtener solo los campos que necesitamos
        $data = $request->only(['name', 'last_name', 'email', 'phone', 'role', 'is_active']);
        $data['is_active'] = $validated['is_active'] ?? true;

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return to_route('admin.users.index')
            ->with('feedback.message', 'Usuario actualizado exitosamente')
            ->with('feedback.type', 'success');
    }

    /**
     * Cambiar estado del usuario
     */
    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'No puedes cambiar tu propio estado');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activado' : 'desactivado';
        return redirect()->back()
            ->with('success', "Usuario {$status} exitosamente");
    }

    /**
     * Eliminar usuario
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'No puedes eliminar tu propia cuenta');
        }

        $user->delete();

        return to_route('admin.users.index')
            ->with('feedback.message', 'Usuario eliminado exitosamente')
            ->with('feedback.type', 'success');
    }
}
