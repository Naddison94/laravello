<div class="lg:mb-4 lg:px-4">
    <div class='flex max-w-xl min-w-min bg-white shadow-md rounded-lg overflow-hidden mx-auto '>
        <div class='flex items-center w-full'>
            <div class='w-full'>
                <header class="flex justify-between leading-tight p-2 md:p-4 bg-white">
                    <div class="flex flex-row">
                        <a class="flex items-center no-underline hover:underline text-black" href="{{ route('user.profile.show', ['id' => $post->author->id]) }}">
                            <img alt="avatar" class="block rounded-full sm:w-14 sm:h-14" src="{{ getUserAvatar($post->author) }}">
                        </a>

                        <div class="flex flex-col mb-2 ml-4 mt-1">
                            <a class="flex items-center no-underline hover:underline text-black" href="{{ route('user.profile.show', ['id' => $post->author->id]) }}">
                                <div class='text-gray-600 text-sm font-semibold'>{{ $post->author->name }}</div>
                            </a>

                            <div class='flex w-full mt-1'>
                                <div class='text-blue-700 font-base text-xs mr-1 hover:underline'>
                                    <a href="{{ route('post.index', ['category[]' => $post->category->id]) }}">{{ $post->category->title }}</a>
                                </div>

                                <div class='text-gray-400 font-thin text-xs'>
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if(Auth::id() == $post->user_id)
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-dropdown align="right">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            @include('components.icons.triple-dots')
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <a class="block p-4 text-center text-gray-700 hover:bg-green-500 hover:text-white" href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                                        <a class="block p-4 text-center text-gray-700 hover:bg-red-500 hover:text-white" href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endif
                    </div>
                </header>

                <div class="border-b border-gray-100">

                </div>

                @if (Route::is('post.show') && $post->img)
                    <div class="flex justify-center m-2 p-2">
                        <a href="/user/{{ $post->author->id }}/post/{{ $post->id }}/{{ $post->img }}" target="_blank">
                            <img alt="img" src="/user/{{ $post->author->id }}/post/{{ $post->id }}/{{ $post->img }}">
                        </a>
                    </div>
                @elseif ($post->img)
                    <div class="flex justify-center m-2 p-2">
                        <a href="{{ route('post.show', ['id' => $post->id]) }}">
                            <img alt="img" src="/user/{{ $post->author->id }}/post/{{ $post->id }}/{{ $post->img }}">
                        </a>
                    </div>
                @endif

                <a class="text-gray-600 font-semibold text-lg mb-2 mx-3 px-2 hover:underline" href="{{ route('post.show', ['id' => $post->id]) }}">
                   {{ $post->title }}
                </a>

                @if ($post->group)
                    <div class='text-blue-700 font-base text-xs mx-3 px-2 hover:underline'>
                        <a href="{{ route('group.show', ['id' => $post->group->id]) }}">{{ $post->group->name }}</a>
                    </div>
                @endif

                @if(Route::is('post.show') && $post->body)
                    <div class='text-gray-500 font-thin text-sm mb-6 mx-3 px-2'>{{ $post->body }}</div>
                @endif

                <div class="flex w-full border-t border-gray-100">
                    <div class="mt-3 mx-5 flex flex-row">
                        <div class='flex text-gray-700 font-normal text-sm rounded-md mb-2 mr-4 items-center'>Comments:<div class="ml-1 text-gray-400 font-thin text-ms">{{ $post->comments_count }}</div></div>
                    </div>

                    @livewire('post.rating', [
                    'post_id' => $post->id,
                    'upvotes' => $post->upvotes_count,
                    'downvotes' => $post->downvotes_count
                    ])

                </div>
            </div>
        </div>
    </div>
</div>
