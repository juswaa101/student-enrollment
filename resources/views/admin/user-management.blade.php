<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 relative mx-auto text-gray-600">
                    <form method="GET" action="{{ route('users.index') }}">
                        <input
                            class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                            type="search" name="search" placeholder="Search by name">
                        <button type="submit" class="relative right-0 top-0 mt-5 mr-4">
                            <div class="rounded-md bg-blue-700 pl-6 pr-6 py-2 mx-4 w-full text-white">
                                Search
                            </div>
                        </button>
                    </form>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="users" class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600 p-4">
                                    Name
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Email
                                </th>
                                <th class="border border-slate-600 p-4">
                                    Created_at
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="whitespace-nowrap">
                                    <td class="border border-slate-700 p-4">
                                        <div class="text-sm text-gray-200">
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        <div class="text-sm text-gray-200">{{ $user->email }}</div>
                                    </td>
                                    <td class="border border-slate-700 p-4">
                                        {{ date('m/d/Y H:i:s A', strtotime($user->created_at)) }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="whitespace-nowrap">
                                    <td colspan="4"
                                        class="font-bold text-center border border-slate-700 p-4 row-span-4 col-span-4">
                                        No Users Yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

        <script src="https://cdn.tailwindcss.com"></script>
</x-app-layout>
