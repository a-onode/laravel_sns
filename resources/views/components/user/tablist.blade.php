<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white">
        <div class="border-b border-gray-200 pb-5 sm:pb-0">
            <div class="mt-3 sm:mt-4">
                <div class="sm:hidden">
                    <label for="current-tab" class="sr-only">Select a tab</label>
                    <select id="current-tab" name="current-tab" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        <option class="" selected>ツイート</option>
                        <option>コメント</option>
                        <option>メディア</option>
                        <option>お気に入り</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <nav class="-mb-px flex justify-evenly space-x-8">
                        <a href="#" data-id="tweet" class="tab-btn border-indigo-500 text-indigo-600 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium" aria-current="page">ツイート</a>
                        <a href="#" data-id="comment" class="tab-btn border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium">コメント</a>
                        <a href="#" data-id="media" class="tab-btn border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium">メディア</a>
                        <a href="#" data-id="favorite" class="tab-btn border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium">お気に入り</a>
                    </nav>
                </div>
            </div>
        </div>
        <section class="tab-content" id="tweet">
            @foreach ($tweets as $tweet)
                <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200 pb-5">
                    <div class="flex space-x-4">
                        <div class="relative flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}" alt="">
                            @if ($user->isOnline())
                                <span class="absolute right-0 top-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                            @else
                                <span class="absolute right-0 top-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        <a href="#" class="hover:underline">{{ $tweet->user->name }}</a>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <a href="#" class="hover:underline">{{ $tweet->created_at->diffForHumans() }}</a>
                                    </p>
                                </div>
                                @if ($tweet->user_id === Auth::id())
                                    <x-tweet.dropdown :tweet="$tweet" />
                                @endif
                            </div>
                            <a href="{{ route('tweets.show', ['tweet' => $tweet->id]) }}" class="mt-2 text-gray-500">{{ $tweet->tweet }}</a>
                            @if (!is_null($tweet->image))
                                <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                                    <div class="flex justify-center mx-auto max-w-4xl">
                                        <img src="{{ 'storage/' . $tweet->image }}" class="rounded-lg shadow-md">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <x-tweet.edit-modal :tweetId="$tweet->id" :tweetText="$tweet->tweet" />
                <x-tweet.delete-modal :tweetId="$tweet->id" :tweetText="$tweet->tweet" />
            @endforeach
        </section>

        <section class="tab-content hidden" id="comment">
            @foreach ($user->comments as $comment)
                <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200 pb-5">
                    <div class="flex space-x-4">
                        <div class="relative flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $comment->user->image) }}" alt="">
                            @if ($user->isOnline())
                                <span class="absolute right-0 top-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                            @else
                                <span class="absolute right-0 top-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        <a href="#" class="hover:underline">{{ $comment->user->name }}</a>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <a href="#" class="hover:underline">{{ $comment->created_at->diffForHumans() }}</a>
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('tweets.show', ['tweet' => $comment->tweet_id]) }}" class="mt-2 text-gray-500">{{ $comment->comment }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        <section class="tab-content hidden" id="media">
            @foreach ($tweets as $tweet)
                @if ($tweet->image)
                    <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200 pb-5">
                        <div class="flex space-x-4">
                            <div class="relative flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}" alt="">
                                @if ($user->isOnline())
                                    <span class="absolute right-0 top-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                                @else
                                    <span class="absolute right-0 top-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            <a href="{{ route('users.show', ['user' => $tweet->user->id]) }}" class="hover:underline">{{ $tweet->user->name }}</a>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <a href="#" class="hover:underline">{{ $tweet->created_at->diffForHumans() }}</a>
                                        </p>
                                    </div>
                                    @if ($tweet->user_id === Auth::id())
                                        <x-tweet.dropdown :tweet="$tweet" />
                                    @endif
                                </div>
                                <p class="mt-2 text-gray-500">{{ $tweet->tweet }}</p>
                                @if (!is_null($tweet->image))
                                    <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                                        <div class="flex justify-center mx-auto max-w-4xl">
                                            <img src="{{ 'storage/' . $tweet->image }}" class="rounded-lg shadow-md">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <x-tweet.edit-modal :tweetId="$tweet->id" :tweetText="$tweet->tweet" />
                    <x-tweet.delete-modal :tweetId="$tweet->id" :tweetText="$tweet->tweet" />
                @endif
            @endforeach
        </section>

        <section class="tab-content hidden" id="favorite">
            @foreach ($favoriteTweets as $tweet)
                <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200 pb-5">
                    <div class="flex space-x-4">
                        <div class="relative flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}" alt="">
                            @if ($tweet->user->isOnline())
                                <span class="absolute right-0 top-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                            @else
                                <span class="absolute right-0 top-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        <a href="{{ route('users.show', ['user' => $tweet->user_id]) }}" class="hover:underline">{{ $tweet->user->name }}</a>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <a href="#" class="hover:underline">{{ $tweet->created_at->diffForHumans() }}</a>
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('tweets.show', ['tweet' => $tweet->id]) }}" class="mt-2 text-gray-500">{{ $tweet->tweet }}</a>
                            @if (!is_null($tweet->image))
                                <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                                    <div class="flex justify-center mx-auto max-w-4xl">
                                        <img src="{{ 'storage/' . $tweet->image }}" class="rounded-lg shadow-md">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
</div>
