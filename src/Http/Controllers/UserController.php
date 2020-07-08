<?php

namespace HaiPhan\BaseL7\Http\Controllers;

use App\Models\User;
use Exception;
use HaiPhan\BaseL7\Http\Filters\UserFilter;
use HaiPhan\BaseL7\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /** @var User $resource */
    protected $resource = User::class;

    /**
     * Display a listing of the resource.
     *
     * @param UserFilter $filter
     * @return JsonResponse
     */
    public function index(UserFilter $filter)
    {
        $user = User::select('*')
            ->search($filter)
            ->paginate(10);

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CreateUserRequest $request)
    {
        $data             = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return  JsonResponse
     */
    public function show(string $id)
    {
        $user = $this->findResource($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        // TODO
    }
}
