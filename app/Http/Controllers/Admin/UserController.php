<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        // Не позволяем снять админку с самого себя
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя изменить свой статус администратора');
        }
        $user->update(['is_admin' => !$user->is_admin]);
        $status = $user->is_admin ? 'назначен' : 'снят';
        return redirect()->back()->with('success', "Статус администратора {$status}");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя удалить самого себя');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Пользователь удалён');
    }
}
