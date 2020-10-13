<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User\User;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\User\Filters\ByOrderIdUser;
use App\Repositories\Eloquent\User\Filters\ByStatusUser;
use App\UseCases\Auth\RegisterService;
use App\Repositories\Eloquent\User\EloquentUserRepository;

class UsersController extends Controller
{
    /**
     * @var RegisterService
     */
    private $service;

    /**
     * @var EloquentUserRepository
     */
    private $users;

    public function __construct(RegisterService $service, EloquentUserRepository $users)
    {
        $this->service = $service;
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->withFilter([new ByOrderIdUser('asc')])->paginate();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateRequest $request)
    {
        $user = User::new(
            $request['name'],
            $request['email']
        );

        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $statuses = [
            User::STATUS_WAIT => 'Waiting',
            User::STATUS_ACTIVE => 'Active',
        ];

        return view('admin.users.edit', compact('user', 'statuses'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email']));

        return redirect()->route('admin.users.show', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {
        $this->service->verify($user->id);

        return redirect()->route('admin.users.show', $user);
    }
}
