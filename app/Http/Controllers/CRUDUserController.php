<?php

namespace App\Http\Controllers;

use App\Models\CRUDUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CRUDUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cruduser = CRUDUser::latest()->paginate(5);
        return view('crud.profile', compact('cruduser'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        CRUDUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profile.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CRUDUser  $cRUDUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = CRUDUser::find($id);
        return view('crud.show', compact('user'))->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CRUDUser  $cRUDUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = CRUDUser::find($id);
        return view('crud.edit', compact('user'))->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CRUDUser  $cRUDUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cRUDUser = CRUDUser::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $cRUDUser->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profile.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CRUDUser  $cRUDUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = CRUDUser::find($id);
        $user->delete();

        return redirect()->route('profile.index')->with('success', 'User deleted successfully');
    }
}
