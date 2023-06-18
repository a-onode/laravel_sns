<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-flash-message />

                    <div class="flex items-start space-x-4">
                        <div class="relative flex-shrink-0">
                            <img class="inline-block h-10 w-10 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}">
                            @if (Auth::user()->isOnline())
                                <span class="absolute right-0 top-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                            @else
                                <span class="absolute right-0 top-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <form action="{{ route('tweets.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="border-b border-gray-200 focus-within:border-indigo-600">
                                    <label for="post" class="sr-only">投稿を追加する</label>
                                    <textarea rows="3" name="tweet" id="tweet" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="投稿を追加する"></textarea>
                                </div>
                                <div class="flex justify-end pt-2">
                                    <div class="flex items-center justify-between space-x-3 px-2 py-2 sm:px-3">
                                        <div class="space-y-5">
                                            <div class="relative flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input aria-describedby="slack-notification" id="slack" name="slack" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-transparent">
                                                </div>
                                                <div class="ml-3 text-sm leading-6">
                                                    <label for="slack" class="font-medium text-gray-900"></label>
                                                    <p id="comments-description" class="text-gray-500">Slackへ通知する</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <label class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                                <svg class="-ml-1 mr-2 h-5 w-5 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span id="file-name" class="text-sm italic text-gray-500 group-hover:text-gray-600">ファイルを追加する</span>
                                                <input id="image" name="image" type="file" class="sr-only" accept="image/png,image/jpeg,image/jpg">
                                            </label>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="submit" id="submit-button" class="inline-flex items-center rounded-md bg-indigo-200 px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" disabled>投稿する</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach ($tweets as $tweet)
                        <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200 pb-5">
                            <div class="flex space-x-4">
                                <div class="relative flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}">
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
                                    <a href="{{ route('tweets.show', ['tweet' => $tweet->id]) }}">
                                        <p class="mt-2 text-gray-500">{{ $tweet->tweet }}</p>
                                    </a>
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
    <script>
        'use strict'
        const fileForm = document.getElementById('image');
        const fileName = document.getElementById('file-name');

        fileForm.addEventListener('change', () => {
            if (window.File) {
                const inputFile = fileForm.files[0];
                console.log(inputFile.name);
                fileName.innerText = inputFile.name;
            }
        });

        const textField = document.getElementById('tweet');
        const submitButton = document.getElementById('submit-button');

        textField.addEventListener('keyup', () => {
            if (textField.value !== '') {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-indigo-200');
                submitButton.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
                submitButton.classList.add('bg-indigo-200');
            }
        });
    </script>
</x-app-layout>
