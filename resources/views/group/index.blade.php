<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div>
                    <div class="p-2 bg-white border-b border-gray-200 rounded-2xl text-center mb-3 shadow-sm">
                        <a href="{{ route('groups.post.create') }}">
                            <button>
                                Submit a post
                            </button>
                        </a>
                    </div>

                    <div class="h-screen sticky top-3">
                        <form>
                            @include('components.posts-filter-sidebar')
                        </form>
                    </div>
                </div>

                <div class="justify-center items-center w-1/2">
                    @forelse($posts as $post)
                        <div>
                            @include('components.post-card-v2')
                        </div>
                    @empty
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200 text-center">
                                    Nothing here yet!

                                    <br>
                                    Join a group to see their posts here

                                    <br>
                                    Or.. create your own
{{--                                    Or.. <a href="{{ route('group.create') }}">create your own</a>--}}
                                </div>
                                <div class="flex items-center justify-center">
                                    <img src="{{ asset('screen.png') }}">
                                </div>
                            </div>
                        </div>
                    @endforelse
                    {{ $posts->links() }}
                </div>

                <div>
                    <div class="top-3">
                        <div class="bg-white w-full top-3 shadow-md rounded-2xl">
                            <div class="p-4 border-b-2">
                                <input type="text" name="search" class="w-full py-1 text-gray-900 rounded-full focus:outline-none" placeholder="search groups" value="{{ app('request')->input('search') }}">
                            </div>

                            <div>
                                <p class="text-gray-900 text-2xl text-center">
                                    My groups
                                </p>

                                @foreach($groups as $group)
                                    <div class="border-t-2 p-4 flex">
                                        <a href="{{ route('group.show', ['id' => $group->id]) }}">
                                            <img alt="avatar" class="sm:w-14 sm:h-14" src="{{ getGroupAvatar($group) }}">
                                        </a>
                                        <a class="flex items-center no-underline hover:underline text-black pl-1" href="{{ route('group.show', ['id' => $group->id]) }}">
                                            {{ $group->name }}
                                        </a>
                                    </div>
                                @endforeach
                                {{ $groups->links() }}
                            </div>
                        </div>
                    </div>

{{--                    <div class="top-3 max-w-sm flex flex-wrap mt-4">--}}
{{--                        <div class="bg-white p-4 top-3 shadow-md rounded-2xl ">--}}
{{--                            <label class="w-full py-1 text-gray-900 rounded-full focus:outline-none">Recently active groups</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="top-3 max-w-sm flex flex-wrap mt-4">
                        <div class="bg-white p-4 top-3 shadow-md rounded-2xl w-full">
                            <p class="py-1 text-gray-900 rounded-full focus:outline-none text-center">
                                Create group
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.alpine.scroll-to-top')
    </div>
</x-app-layout>

