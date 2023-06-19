<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-green-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap -mx-1 lg:-mx-4">
                        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                            <article class="overflow-hidden rounded-lg shadow-lg border border-gray-700">
                                @can('student')
                                    <h1 class="text-center text-7xl py-16">{{ $enrolledSubjectsCount->subjects_count }}</h1>
                                @else
                                    <h1 class="text-center text-7xl py-16">{{ $enrolledSubjectsCount[0]->enrolled_count }}
                                    </h1>
                                @endcan
                                <header class="flex items-center justify-center leading-tight p-2 md:p-16">
                                    <h1 class="text-2xl">Approved Subject</h1>
                                </header>
                            </article>
                        </div>
                        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                            <article class="overflow-hidden rounded-lg shadow-lg border border-gray-700">
                                @can('student')
                                    <h1 class="text-center text-7xl py-16">
                                        {{ $pendingEnrolledSubjectsCount->subjects_count }}</h1>
                                @else
                                    <h1 class="text-center text-7xl py-16">
                                        {{ $pendingEnrolledSubjectsCount[0]->pending_count }}
                                    </h1>
                                @endcan

                                <header class="flex items-center justify-center leading-tight p-2 md:p-16">
                                    <h1 class="text-2xl">Pending Subject</h1>
                                </header>
                            </article>
                        </div>
                        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                            <article class="overflow-hidden rounded-lg shadow-lg border border-gray-700">
                                @can('student')
                                    <h1 class="text-center text-7xl py-16">
                                        {{ abs($subjects->total() -auth()->user()->subjects->count()) }}</h1>
                                @else
                                    <h1 class="text-center text-7xl py-16">{{ $subjects }}</h1>
                                @endcan

                                <header class="flex items-center justify-center leading-tight p-2 md:p-16">
                                    <h1 class="text-2xl">Available Subject</h1>
                                </header>
                            </article>
                        </div>
                        @can('admin')
                            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                                <article class="overflow-hidden rounded-lg shadow-lg border border-gray-700">
                                    @can('student')
                                        <h1 class="text-center text-7xl py-16">
                                            {{ auth()->user()->count() - 1 }}</h1>
                                    @else
                                        <h1 class="text-center text-7xl py-16">{{ $subjects }}</h1>
                                    @endcan

                                    <header class="flex items-center justify-center leading-tight p-2 md:p-16">
                                        <h1 class="text-2xl">Total Students</h1>
                                    </header>
                                </article>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
