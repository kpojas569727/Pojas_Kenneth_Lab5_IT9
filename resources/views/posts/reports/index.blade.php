<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog Post Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filter card --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    Filter your blog posts and download a PDF or CSV report.
                </p>

                <form action="{{ route('posts.reports.index') }}" method="GET"
                      class="flex flex-wrap items-end gap-4">
                    <div>
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        <x-text-input id="start_date" name="start_date" type="date"
                                      class="mt-1 block"
                                      :value="old('start_date', $startDate)" />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="__('End Date')" />
                        <x-text-input id="end_date" name="end_date" type="date"
                                      class="mt-1 block"
                                      :value="old('end_date', $endDate)" />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>{{ __('Generate Report') }}</x-primary-button>

                        <a href="{{ route('posts.reports.index') }}"
                           class="text-sm text-gray-600 dark:text-gray-400 underline hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Reset Filters') }}
                        </a>
                    </div>
                </form>
            </div>

            {{-- Summary + export buttons --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="text-gray-900 dark:text-gray-100">
                        <p class="text-sm">
                            <strong>Period:</strong>
                            {{ $startDate ?: 'Beginning' }} to {{ $endDate ?: 'Present' }}
                        </p>
                        <h3 class="text-lg font-semibold">Total Posts: {{ $totalPosts }}</h3>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('posts.reports.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition">
                            Export PDF
                        </a>

                        <a href="{{ route('posts.reports.csv', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 transition">
                            Export CSV
                        </a>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Body Preview</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Created Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                        @forelse ($posts as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
                                <td class="px-6 py-4">{{ $post->title }}</td>
                                <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No posts found for the selected dates.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('posts.index') }}"
               class="inline-block text-sm text-gray-600 dark:text-gray-400 underline hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Back to Blog Posts
            </a>
        </div>
    </div>
</x-app-layout>