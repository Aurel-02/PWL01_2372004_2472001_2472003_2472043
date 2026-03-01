<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role', 'user');
        $users = User::where('role', $role)->latest()->paginate(15);
        
        return view('admin.users.index', compact('users', 'role'));
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus admin.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
