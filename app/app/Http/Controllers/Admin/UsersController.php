<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\SearchRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Http\Search\Admin\UserSearch;
use App\UseCases\Auth\RegisterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    private $service;
    private $search;

    public function __construct(RegisterService $service,UserSearch $search)
    {
        $this->service=$service;
        $this->search=$search;
    }


    public function index(SearchRequest $request)
    {

        $users = $this->search->search($request);
        return view('admin.users.index', [
            'users'=>$users,
            'statuses'=>User::$statuses,
            'roles'=>User::$rolesName,
            'permissions'=>User::$permissions
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateRequest $request)
    {
        $user = User::new($request);
        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {

        return view('admin.users.edit', [
            'user'=>$user,
            'roles'=>User::$rolesName,
            'permissions'=>User::$permissions
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email']));
        if ($request->role !== $user->role) {
            $user->changeRole($request->role);
        }
        if ($request->permission !== $user->permission) {
            $user->changePermission($request->permission);
        }

        return redirect()->route('admin.users.show', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {
        $user->verify();

        return redirect()->route('admin.users.show', $user);
    }
}
