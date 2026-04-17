<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles')->withCount('orders')->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }
        if ($request->filled('role')) {
            $query->whereHas('roles', fn($q) => $q->where('name', $request->role));
        }
        $users = $query->paginate(25)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['orders.items', 'addresses', 'vehicles.engine.carModel.make', 'roles']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'role'       => 'required|in:admin,manager,client',
        ]);
        $user->update($request->only('first_name', 'last_name', 'email', 'phone'));
        $user->syncRoles([$request->role]);
        if ($request->filled('new_password')) {
            $user->update(['password' => Hash::make($request->new_password)]);
        }
        return back()->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
        $user->delete();
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur supprimé.');
    }

    public function toggle(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'Statut modifié.');
    }
}
