<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enrollments') }}
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 relative mx-auto text-gray-600">
                    <form method="GET" action="{{ route('enrollments.index') }}">
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
                    <table id="enrollments" class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600 p-4">
                                    Student
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Subject Code
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Enrolled At
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Status
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enrollments as $enrollment)
                                @foreach ($enrollment->subjects as $subject)
                                    <tr class="whitespace-nowrap">
                                        <td class="border border-slate-700 p-4">
                                            {{ $enrollment->name }}
                                        </td>
                                        <td class="border border-slate-700 p-4">
                                            <div class="text-sm text-gray-200">
                                                {{ $subject->code }}
                                            </div>
                                        </td>
                                        <td class="border border-slate-700 p-4">
                                            <div class="text-sm text-gray-200">
                                                {{ date('m/d/Y H:i:s A', strtotime($subject->pivot->created_at)) }}
                                            </div>
                                        </td>
                                        <td class="border border-slate-700 p-4">
                                            {{ $subject->pivot->status == 1 ? 'Approved' : 'Pending' }}
                                        </td>
                                        <td class="border border-slate-700 p-4 text-center">
                                            <form method="POST" class="mb-2"
                                                action="{{ route('enrollments.update', [$subject->id, $enrollment->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                @if ($subject->pivot->status == 1)
                                                    <button type="submit"
                                                        class="rounded-md bg-gray-700 pl-6 pr-6 py-2">Pending</button>
                                                @else
                                                    <button type="submit"
                                                        class="rounded-md bg-blue-700 pl-6 pr-6 py-2">Approve</button>
                                                @endif
                                            </form>
                                            <form method="POST"
                                                action="{{ route('enrollments.destroy', [$subject->id, $enrollment->id]) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-md bg-red-700 pl-8 pr-8 py-2">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr class="whitespace-nowrap">
                                    <td colspan="4"
                                        class="font-bold text-center border border-slate-700 p-4 row-span-4 col-span-4">
                                        No Enrollments Yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $enrollments->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

        <script src="https://cdn.tailwindcss.com"></script>
</x-app-layout>
