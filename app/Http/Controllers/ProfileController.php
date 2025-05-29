<?php

namespace App\Http\Controllers;
use App\Models\Mistake;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $mistakes = $request->user()->mistakes()->latest()->paginate(10);

        return view('profile.edit', [
            'user' => $request->user(),
            'mistakes' => $mistakes // Передаем ошибки в представление
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        // Обработка аватара
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $data['avatar'] = file_get_contents($avatar->getRealPath());
        } elseif ($request->input('remove_avatar')) {
            $data['avatar'] = null;
        } else {
            unset($data['avatar']); // Не обновляем аватар, если файл не был загружен
        }

        $user->fill($data);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
