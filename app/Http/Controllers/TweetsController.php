<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Tweet;
use App\Services\ImageService;
use App\Http\Requests\TweetStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followingId = Follower::where('following_id', Auth::id())->select('followed_id')->get();
        $followingId[] = Auth::id();
        $tweets = Tweet::whereIn('user_id', $followingId)->latest()->get();

        return view('tweets.index', compact('tweets'));
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
    public function store(TweetStoreRequest $request)
    {
        $imageFile = $request->file('image');
        if (!is_null($imageFile)) {
            $fileNameToStore = ImageService::upload($imageFile);

            Tweet::create([
                'user_id' => Auth::id(),
                'tweet' => $request->tweet,
                'image' => $fileNameToStore,
            ]);

            return redirect()->route('tweets.index');
        }

        Tweet::create([
            'user_id' => Auth::id(),
            'tweet' => $request->tweet,
        ]);

        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::findOrFail($id);

        return view('tweets.show', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $tweet = Tweet::findOrFail($id);
        $imageFile = $request->file('image');

        $tweet->tweet = $request->tweet;
        if (!is_null($imageFile)) {
            $fileNameToStore = ImageService::upload($imageFile);
            $tweet->image = $fileNameToStore;
        }
        $tweet->save();

        return redirect()->route('tweets.index')
            ->with([
                'message' => '投稿を更新しました。',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();

        return redirect()->route('tweets.index')
            ->with([
                'message' => '投稿を削除しました。',
            ]);
    }
}
