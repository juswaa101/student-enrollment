<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subjects') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <a href="{{ route('subjects.create') }}" class="relative right-0 top-0 mt-5 mr-4">
            <div class="w-2/12 mx-auto text-center rounded-md w- bg-green-700 pl-6 pr-6 py-2 mt-4 text-white">
                Add Subject
            </div>
        </a>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 relative mx-auto text-gray-600">
                    <form method="GET" action="{{ route('subjects.index') }}">
                        <input
                            class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                            type="search" name="search" placeholder="Search by subject code">
                        <button type="submit" class="relative right-0 top-0 mt-5 mr-4">
                            <div class="rounded-md bg-blue-700 pl-6 pr-6 py-2 mx-4 w-full text-white">
                                Search
                            </div>
                        </button>
                    </form>
                    @if (Session::has('success'))
                        <div class="bg-white dark:bg-green-700 overflow-hidden shadow-sm sm:rounded-lg my-4">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="bg-white dark:bg-red-700 overflow-hidden shadow-sm sm:rounded-lg my-4">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{ Session::get('error') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="subjects" class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600 p-4">
                                    Subject Code
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Subject Title
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Subject Description
                                </th>
                                <th class="border border-slate-600 p-4">
                                    No of Student Enrolled
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr class="whitespace-nowrap">
                                    <td class="border border-slate-700 p-4">
                                        {{ $subject->code }}
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        <div class="text-sm text-gray-200">
                                            {{ $subject->title }}
                                        </div>
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        {{ Str::limit($subject->description, 50) }}
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        {{ $subject->users_count }}
                                    </td>
                                    <td class="border border-slate-700 p-4 text-center">
                                        <a href="{{ route('subjects.edit', $subject->id) }}"
                                            class="rounded-md bg-blue-700 pl-8 pr-8 py-2 w-full">Edit</a>
                                        @if ($subject->users_count == 0)
                                            <form onsubmit="return confirm('Are you sure you want to delete this?')"
                                                method="POST" action="{{ route('subjects.destroy', $subject->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-md bg-red-700 pl-6 pr-6 py-2 mt-4">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="whitespace-nowrap">
                                    <td colspan="4"
                                        class="font-bold text-center border border-slate-700 p-4 row-span-4 col-span-4">
                                        No Subjects Yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $subjects->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#subjects').DataTable();
            });
        </script>

        <script src="https://cdn.tailwindcss.com"></script>
</x-app-layout>
