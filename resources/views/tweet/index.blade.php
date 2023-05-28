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
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <img class="inline-block h-10 w-10 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}">
                        </div>
                        <div class="min-w-0 flex-1">
                            <form action="{{ route('tweets.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="border-b border-gray-200 focus-within:border-indigo-600">
                                    <label for="comment" class="sr-only">投稿を追加する</label>
                                    <textarea rows="3" name="tweet" id="tweet" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="投稿を追加する"></textarea>
                                </div>
                                <div class="flex justify-end pt-2">
                                    <div class="flex items-center justify-between space-x-3 px-2 py-2 sm:px-3">
                                        <div class="flex">
                                            <label class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                                <svg class="-ml-1 mr-2 h-5 w-5 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-sm italic text-gray-500 group-hover:text-gray-600">ファイルを追加する</span>
                                                <input id="image" name="image" type="file" class="sr-only">
                                            </label>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">投稿する</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach ($tweets as $tweet)
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
                                            <x-tweet.dropdown :tweetId="$tweet->id" />
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
                        <x-tweet.edit-modal :tweetId="$tweet->id" :tweet="$tweet->tweet" />
                        <div id="delete-modal-{{ $tweet->id }}" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                            <div class="fixed inset-0 bg-gray-500 bg-opacity-20 transition-opacity"></div>

                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                        <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                                            <button type="button" class="delete-close-button rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" data-target="delete-modal-{{ $tweet->id }}">
                                                <span class="sr-only">Close</span>
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold leading-6 text-gray-900">この投稿を削除しますか？</h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">{{ $tweet->tweet }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                            <form action="{{ route('tweets.destroy', ['tweet' => $tweet->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">削除する</button>
                                            </form>
                                            <button type="button" class="delete-close-button mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" data-target="delete-modal-{{ $tweet->id }}">キャンセル</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
