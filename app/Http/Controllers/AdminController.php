<?php

namespace App\Http\Controllers;

use App\Models\Backend\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function settingsUpdate(Admin $admin, Request $request) {
        $v = Validator::make($request->all(), [
            'email' => ['required', Rule::unique('admins')->ignore($request->id)],
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        $admin->email = $request->email;
        $admin->save();

        return response()->json(['status' => 1],200);
    }

    public function passwordUpdate(Admin $admin, Request $request) {
        $v = Validator::make($request->all(), [
            'old_password' => ['required', function ($attribute, $value, $fail) use ($admin) {
                if (!Hash::check($value, $admin->password)) {
                    $fail($attribute.' is invalid.');
                }
            },],
            'password' => 'required|confirmed'
        ]);

        if($v->fails()) {
            return response()->json(['errors' => $v->errors()],400);
        }

        $admin->password = bcrypt($request->password);
        $admin->save();

        return response()->json(['status' => 1],200);
    }
}