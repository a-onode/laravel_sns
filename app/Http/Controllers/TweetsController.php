<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

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

        return view('tweet.index', compact('tweets'));
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
        $imageFile = $request->file('image');
        if (!is_null($imageFile)) {
            $fileName = uniqid(rand() . '_');
            $extention = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extention;

            Storage::putFileAs('public', $imageFile, $fileNameToStore);
        }

        Tweet::create([
            'user_id' => Auth::id(),
            'tweet' => $request->tweet,
            'image' => $fileNameToStore,
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
        //
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
