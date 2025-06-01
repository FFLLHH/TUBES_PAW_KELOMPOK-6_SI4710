<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all()->sortByDesc('id'),
            'title' => 'Manajemen User'
        ];

        return view('admin.user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];

        return view('admin.user.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('userCreate')->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'user' => User::findOrFail($id),
            'title' => 'Edit User'
        ];

        return view('admin.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('userEdit', $id)->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        // Update password jika diisi
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting self
        if ($user->id === auth()->user()->id) {
            return redirect()->route('users')->with('failed', 'Tidak dapat menghapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'User berhasil dihapus');
    }
} 