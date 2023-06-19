<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pending Enrolled Subjects') }} - ({{ $pendingEnrolledSubjectsCount->subjects_count }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('success'))
                <div class="bg-white dark:bg-green-700 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 relative mx-auto text-gray-600">
                    <form method="GET" action="{{ route('pending.enrolled.subjects') }}">
                        <input
                            class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                            type="search" name="search" placeholder="Search by subject code">
                        <button type="submit" class="relative right-0 top-0 mt-5 mr-4">
                            <div class="rounded-md bg-blue-700 pl-6 pr-6 py-2 mx-4 w-full text-white">
                                Search
                            </div>
                        </button>
                    </form>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600 p-4">Subject Code</th>
                                <th class="border border-slate-600 p-4">Subject</th>
                                <th class="border border-slate-600 p-4">Description</th>
                                <th class="border border-slate-600 p-4">Status</th>
                                <th class="border border-slate-600 p-4">Date Enrolled</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user->subjects as $subject)
                                <tr>
                                    <td class="border border-slate-700 p-4">{{ $subject->code }}</td>
                                    <td class="border border-slate-700 p-4">{{ $subject->title }}</td>
                                    <td class="border border-slate-700 p-4">
                                        <p>
                                            {{ $subject->description }}</p>
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        {{ $subject->pivot->status == 1 ? 'Approved' : 'Pending' }}
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        {{ date('m/d/Y H:i:s A', strtotime($subject->pivot->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="font-bold text-center border border-slate-700 p-4 row-span-4 col-span-4">
                                        No Pending Enrolled Subject Yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $user->subjects->render() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</x-app-layout>
