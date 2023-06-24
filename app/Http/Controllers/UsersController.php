<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use App\Services\ImageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $favoriteTweets = UserService::getFavoriteTweets(Auth::id());

        return view('users.index', compact('user', 'favoriteTweets'));
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
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        $favoriteTweets = UserService::getFavoriteTweets($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index', compact('user', 'favoriteTweets'));
        } else {
            return view('users.show', compact('user', 'favoriteTweets'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = User::findOrFail($id);
        $imageFile = $request->file('image');
        $backgroundImageFile = $request->file('background-image');

        $user->name = $request->name;
        $user->description = $request->description;
        if (!is_null($imageFile)) {
            $fileNameToStore = ImageService::upload($imageFile);
            $user->image = $fileNameToStore;
        }

        if (!is_null($backgroundImageFile)) {
            $fileNameToStore = ImageService::upload($backgroundImageFile);
            $user->background_image = $fileNameToStore;
        }
        $user->save();

        return redirect()->route('users.edit', compact('user'))
            ->with([
                'message' => 'プロフィールを更新しました。',
            ]);
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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = User::query();

        if (!is_null($keyword)) {
            $spaceConvert = mb_convert_kana($keyword, 's');
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($keywords as $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            }

            $users = $query->paginate(20);

            return view('users.search', compact('users', 'keyword'));
        } else {
            $users = $query->paginate(20);
            return view('users.search', compact('users'));
        }
    }
}
