<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div>
                    <div class="p-2 bg-white border-b border-gray-200 rounded-2xl text-center mb-3 shadow-sm">
                        <a href="{{ route('post.create') }}">
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
                    @foreach($posts as $post)
                        <div>
                            @include('components.post-card-v2')
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        @include('components.alpine.scroll-to-top')
    </div>
</x-app-layout>

