<x-admin-layout>
    <div x-data="{ openModal: false }">
        <h1 class="text-2xl font-extrabold px-4 py-2">Students</h1>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Students
            </h2>
        </x-slot>
        <div class="p-6">
            <div class="bg-white shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Student List</h3>
                    <button @click="openModal = true" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700">
                        Add Student
                    </button>
                </div>
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Matric No</th>
                            <th class="px-4 py-2 text-left">Course</th>
                            <th class="px-4 py-2 text-left">RFID</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td class="px-4 py-2 text-left">{{ $student->student_id }}</td>
                            <td class="px-4 py-2 text-left">{{ $student->name }}</td>
                            <td class="px-4 py-2 text-left">{{ $student->matric_no }}</td>
                            <td class="px-4 py-2 text-left">{{ $student->course }}</td>
                            <td class="px-4 py-2 text-left">{{ $student->rfid_code }}</td>
                            <td class="p-2">
                                <button type="button" class="flex-inline bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded">Edit</button>
                                <button type="button" class="flex-inline bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded mt-1">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Background -->
        <div x-show="openModal" @click.away="openModal = false" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <!-- Modal Box -->
            <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold mb-4">
                    Add Student
                </h2>
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="block text-sm">Name</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <!-- Matric No -->
                    <div class="mb-3">
                        <label class="block text-sm">Matric No</label>
                        <input type="text" name="matric_no" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <!-- Course -->
                    <div class="mb-3">
                        <label class="block text-sm">Course</label>
                        <input type="text" name="course" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <!-- RFID -->
                    <div class="mb-3">
                        <label class="block text-sm">RFID Code</label>
                        <input type="text" name="rfid_code" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button
                            type="button" @click="openModal = false" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>