<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\User;
use Exception;
use App\Models\Role;

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
        $roles = Role::get()->toArray();
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
        //必要な情報の取得
        $account = User::find($id);
        $roles = Role::get(["role"])->toArray();
        $roles = Arr::flatten($roles);
        //バリデーション
        $validated = $request->validate([
            'role' => ['required', 'not_in:0', Rule::in($roles)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($account->id)],
            'title' => ['required', 'max:255'],
            'name' => ['required'],
            'bio' => ['max:160']
        ]);
        $account->forceFill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'title' => $validated['title'],
            'bio' => $validated['bio'],
        ])->save();
        DB::beginTransaction();
        try {
            $account = new User([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'title' => $validated['title'],
                'bio' => $validated['bio'],
            ]);
            $account->save();
            $account->roles()->sync($request->get('role'));
        } catch (Exception $e) {
            DB::rollback();
        }
        DB::commit();

        return Redirect::route('admin.account')
            ->with('success', 'Post Created Successfully.');
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
