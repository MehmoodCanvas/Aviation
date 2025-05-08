<?php

namespace App\Http\Controllers\Front\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'member_email' => 'required|email',
            'member_password' => 'required|string',
        ]);

        $member = \App\Models\Member::where('member_email', $request->member_email)->first();

        if (!$member || !Hash::check($request->member_password, $member->member_password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $member->createToken('member-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => $member,
        ], 200);
    }

    public function signup(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'member_full_name' => 'required|string|max:255',
            'member_email' => 'required|string|email|max:255|unique:member,member_email',
            'member_password' => 'required|string|min:8',
            'member_role' => 'required',
            'member_profile' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['member_password'] = Hash::make($data['member_password']);
        $user = \App\Models\Member::create($data);
        $token = $user->createToken('member-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
