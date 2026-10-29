<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <a href="{{ route('posts.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-500">
                + New Post
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($posts as $post)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h3>
                    <p class="mt-2 text-gray-700">{{ \Illuminate\Support\Str::limit($post->body, 150) }}</p>

                    <div class="mt-4 flex items-center gap-4">
                        <a href="{{ route('posts.show', $post) }}" class="text-sm text-blue-600 hover:underline">View</a>
                        <a href="{{ route('posts.edit', $post) }}" class="text-sm text-yellow-600 hover:underline">Edit</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                              onsubmit="return confirm('Delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    No posts yet.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
