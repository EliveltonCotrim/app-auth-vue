<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsers($userAuthid)
    {
        $users = User::where('id', '!=', $userAuthid)->orderBy('name')->paginate(2);
        return response()->json($users);
    }
}
