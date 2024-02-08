<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\createRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $userAuthid = Auth::user()->id;
        $users = User::where('id', '!=', $userAuthid)->orderBy('name')->paginate(10);
        return Inertia::render('Users/Index', ['users' => $users, 'userAuthid' => $userAuthid]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(createRequest $request): RedirectResponse
    {
        User::create($request->except('_token', 'password_confirmation') + [
            'password' =>  Hash::make($request->password)
        ]);

        return to_route('users');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', ['user' => $user]);
    }
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->except('_token', 'password_confirmation', 'password');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return to_route('users');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return to_route('users');
    }
}
