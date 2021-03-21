<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'roles.role', 'roles.title as role_title')
            ->paginate(15)->toArray();

        return Inertia::render('Admin/Account/Index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'roles.role', 'roles.title as role_title')
            ->find($id);
        return Inertia::render('Admin/Account/Show', ['account' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $account = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'roles.role', 'roles.title as role_title')
            ->find($id);
        $roles = Role::get()->pluck('title', "id")->toArray();
        return Inertia::render(
            'Admin/Account/Edit',
            ['account' => $account, 'roles' => $roles]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
