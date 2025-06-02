<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('is_banned')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.users', compact('users'));
    }

    public function ban(User $user, Request $request)
    {
        $request->validate([
            'ban_reason' => 'required|string|max:255'
        ]);

        $user->update([
            'is_banned' => 1,
            'ban_reason' => $request->ban_reason
        ]);

        return back()->with('success', 'Пользователь успешно заблокирован');
    }

    public function unban(User $user)
    {
        $user->update([
            'is_banned' => 0,
            'ban_reason' => null
        ]);

        return back()->with('success', 'Пользователь успешно разблокирован');
    }

    public function makeModerator(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update(['role' => User::ROLE_MODERATOR]);
        return back()->with('success', 'Пользователю выданы права модератора');
    }

    public function removeModerator(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update(['role' => User::ROLE_USER]);
        return back()->with('success', 'Права модератора сняты');
    }
}
