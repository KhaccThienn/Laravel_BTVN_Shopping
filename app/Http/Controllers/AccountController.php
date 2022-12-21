<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::orderBy('role','desc')->paginate(3);
        return view('admin.account.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAccountRequest $request)
    {
        try {
            $request->validated();
            $password = Hash::make($request->password);
            $request->merge(['password' => $password]);
            User::create($request->all());
            return redirect()->route('account.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc = User::find($id);
        return view('admin.account.update', compact('acc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        $request->validated();
        $password = User::find($id)->password;
        if (Hash::check($request->password, User::find($id)->password)) {
            $password = Hash::make($request->password);
        } else {
            return redirect()->back()->with('success', 'The Old Password does not match');
        }
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'status' => $request->status,
            'role' => $request->role,
        ]);

        return redirect()->route('account.index')->with('success', "Update Data Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('account.recycle_bin')->with('success', 'Delete Data Successfully');
    }

    public function recycle_bin()
    {
        $accounts = User::onlyTrashed()->get();
        return view('admin.account.trash', compact('accounts'));
    }

    public function restored($id)
    {
        User::onlyTrashed()->find($id)->restore();
        return redirect()->route('account.index')->with('success', 'Restore Sucessfully');
    }

    public function force_delete($id)
    {
        User::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('account.index')->with('success', 'Delete Sucessfully');
    }
}
