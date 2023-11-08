<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create(Request $request)
    {
        Log::info("Hit create User");
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        return $user;
    }

    public function edit(Request $request, $id)
    {
        Log::info("Hit edit User");
        $user = User::findorfail($id);
        if ($user) {
            if ($request->name) {
                $user->name = $request->name;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            $user->save();
        }
    return $user;
    }

    public function delete($id){
        Log::info("Hit delete User");
        $user = User::findorfail($id);
        $user->delete();
        return response()->json(['message'=>"User Deleted Successfully"]);
    
    }
}
