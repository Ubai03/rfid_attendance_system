<x-admin-layout>
    <h1 class="text-2xl font-extrabold px-4 py-2">Dashboard</h1>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold mb-4">
                        Attendance Record
                    </h3>
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex items-center space-x-3">
                        <label class="font-medium text-gray-700">
                            Select Date:
                        </label>
                        <input
                            type="date"
                            name="date"
                            value="{{ request('date') }}"
                            class="border rounded-lg px-2 py-1 shadow-sm focus:ring focus:ring-blue-200"
                        >
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700"
                        >
                            Filter
                        </button>
                    </form>
                </div>
                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">ID</th>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Check-in</th>
                            <th class="p-2 text-left">Check-out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="p-2">1</td>
                            <td class="p-2">Ali Ahmad</td>
                            <td class="p-2">08:02</td>
                            <td class="p-2">17:10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>