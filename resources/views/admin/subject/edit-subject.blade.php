<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Subject') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('success'))
                <div class="bg-white dark:bg-green-700 overflow-hidden shadow-sm sm:rounded-lg my-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 relative mx-auto text-gray-600">
                    <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
                        @csrf
                        <!-- component -->
                        <div class="w-full bg-gray-800 h-screen">
                            @if ($errors->any())
                                <div role="alert">
                                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                        Validation Error
                                    </div>
                                    <div
                                        class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="bg-gradient-to-b h-80"></div>
                            <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8">
                                <div class="bg-gray-900 w-full shadow rounded p-8 sm:p-12 -mt-72">
                                    <form action="{{ route('subjects.update', $subject->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="md:flex items-center mt-12">
                                            <div class="w-full md:w-1/2 flex flex-col">
                                                <label class="font-semibold leading-none text-gray-300">Subject
                                                    Code</label>
                                                <input type="text" name="code" value="{{ $subject->code }}"
                                                    readonly placeholder="Subject Code eg. SUB-001"
                                                    class="leading-none text-gray-50 p-3 focus:outline-none focus:border-blue-700 mt-4 border-0 bg-gray-800 rounded" />
                                            </div>
                                            <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                                                <label class="font-semibold leading-none text-gray-300">Title</label>
                                                <input type="text" name="title" value="{{ $subject->title }}"
                                                    placeholder="Subject Title eg. Life and Works of Rizal"
                                                    class="leading-none text-gray-50 p-3 focus:outline-none focus:border-blue-700 mt-4 border-0 bg-gray-800 rounded" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="w-full flex flex-col mt-8">
                                                <label
                                                    class="font-semibold leading-none text-gray-300">Description</label>
                                                <textarea type="text" name="description" style="resize: none;"
                                                    class="h-40 text-base leading-none text-gray-50 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-800 border-0 rounded">{{ $subject->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center w-full">
                                            <button type="submit"
                                                class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.tailwindcss.com"></script>
</x-app-layout>
