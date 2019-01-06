<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = new User;
        $user->fill($request->all());

        $result = \DB::transaction(function () use ($user) {
            return $user->save();
        });
        if ($result) {
            $request->session()->flash('message', '保存しました。');
            return redirect('users');
        } else {
            $request->session()->flash('message', 'エラーが発生しました。');
            return view('users.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if ($request->password) {
            $request->validate([
                'name' => 'required|string|max:100',
                'password' => 'required|string|min:6|max:100|confirmed',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:100',
            ]);
        }

        $user->name = $request->name;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $result = \DB::transaction(function () use ($user) {
            return $user->save();
        });
        if ($result) {
            $request->session()->flash('message', '更新しました。');
            return redirect('users');
        } else {
            $request->session()->flash('message', 'エラーが発生しました。');
            return view('users.edit', ['user' => $user]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = \DB::transaction(function () use ($user) {
            return $user->delete();
        });
        if ($result) {
            return redirect('users')->with('message', '削除しました。');
        } else {
            return redirect('users')->with('message', 'エラーが発生しました。');
        }
    }
}
