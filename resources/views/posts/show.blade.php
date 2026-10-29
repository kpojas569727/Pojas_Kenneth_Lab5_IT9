<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $post->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-xs text-gray-500">Posted {{ $post->created_at->format('M d, Y') }}</p>
                <div class="mt-4 text-gray-700 whitespace-pre-line">{{ $post->body }}</div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:underline">← Back</a>
                    <a href="{{ route('posts.edit', $post) }}" class="text-sm text-yellow-600 hover:underline">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>