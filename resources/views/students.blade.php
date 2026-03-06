<x-admin-layout>
    <h1 class="text-2xl font-extrabold px-4 py-2">Students</h1>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Students
        </h2>
    </x-slot>
    <div class="p-6">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Student List</h3>
                <button class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700">
                    Add Student
                </button>
            </div>
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">ID</th>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Matric No</th>
                        <th class="p-2 text-left">Course</th>
                        <th class="p-2 text-left">RFID</th>
                        <th class="p-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="p-2">1</td>
                        <td class="p-2">Ali Ahmad</td>
                        <td class="p-2">A12345</td>
                        <td class="p-2">Computer Science</td>
                        <td class="p-2">9F 32 8A 11</td>
                        <td class="p-2">
                            Edit | Delete
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>