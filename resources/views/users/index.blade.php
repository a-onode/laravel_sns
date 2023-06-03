<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                                        <button type="button" class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                            </svg>
                                            <span>編集する</span>
                                        </button>
                                    </a>
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
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}" alt="">
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
