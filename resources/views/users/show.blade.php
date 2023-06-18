<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />
                    <div>
                        <div>
                            <img class="h-32 w-full object-cover lg:h-48" src="https://images.unsplash.com/photo-1444628838545-ac4016a5418a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="">
                        </div>
                        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                            <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                                <div class="flex">
                                    <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32 bg-white" src="{{ asset('storage/' . $user->image) }}" alt="">
                                </div>
                                <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                                    <div class="mt-6 min-w-0 flex-1 sm:hidden md:block">
                                        <h1 class="truncate text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                    </div>
                                    @if ($user->isFollow(Auth::id()) === true)
                                        <form action="{{ route('followers.destroy', ['follower' => $user->id]) }}" method="post" class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                <span>フォロー中</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('followers.store') }}" method="post" class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                                            @csrf
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                <span>フォローする</span>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                            <div class="px-4 py-5 sm:px-6">
                                <p class="mt-1 text-sm text-gray-500">{{ $user->description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white">
                            <div class="border-b border-gray-200 pb-5 sm:pb-0">
                                <div class="mt-3 sm:mt-4">
                                    <!-- Dropdown menu on small screens -->
                                    <div class="sm:hidden">
                                        <label for="current-tab" class="sr-only">Select a tab</label>
                                        <select id="current-tab" name="current-tab" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option selected>ツイート</option>
                                            <option>コメント</option>
                                            <option>メディア</option>
                                            <option>お気に入り</option>
                                        </select>
                                    </div>
                                    <!-- Tabs at small breakpoint and up -->
                                    <div class="hidden sm:block">
                                        <nav class="-mb-px flex justify-evenly space-x-8">
                                            <a href="#" class="border-indigo-500 text-indigo-600 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium" aria-current="page">ツイート</a>
                                            <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium">コメント</a>
                                            <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium">メディア</a>
                                            <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium">お気に入り</a>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            @foreach ($user->tweets as $tweet)
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
