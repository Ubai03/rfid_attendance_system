<x-admin-layout>
    <!-- Notification Popup -->
    <div id="notification" class="hidden fixed top-6 right-6 z-50 min-w-72 max-w-sm px-5 py-4 rounded-xl shadow-xl text-white transition-all duration-500">
        <div class="flex items-center space-x-3">
            <div id="notif-icon" class="text-2xl"></div>
            <div>
                <p id="notif-student" class="font-bold text-sm"></p>
                <p id="notif-message" class="text-sm opacity-90"></p>
                <p id="notif-time" class="text-xs opacity-70 mt-1"></p>
            </div>
        </div>
    </div>
    <h1 class="text-2xl font-extrabold px-4 py-2">Dashboard</h1>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold mb-4">
                        Attendance Record
                    </h3>
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex items-center space-x-3">
                        <label class="font-medium text-gray-700">
                            Select Date:
                        </label>
                        <input type="date" name="date" value="{{ request('date') }}" class="border rounded-lg px-2 py-1 shadow-sm focus:ring focus:ring-blue-200">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700">
                            Filter
                        </button>
                    </form>
                </div>
                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Matric No</th>
                            <th class="px-4 py-2 text-left">Time-in</th>
                            <th class="px-4 py-2 text-left">Time-out</th>
                            <th class="px-4 py-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendance as $record)
                        <tr>
                            <td class="px-4 py-2">{{ $record->attendance_id }}</td>
                            <td class="px-4 py-2">{{ $record->student_name }}</td>
                            <td class="px-4 py-2">{{ $record->matrix_no }}</td>
                            <td class="px-4 py-2">{{ $record->time_in }}</td>
                            <td class="px-4 py-2">{{ $record->time_out }}</td>
                            <td class="px-4 py-2">{{ $record->date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let lastTime = null;

        function checkNotification() {
            fetch('{{ url("/api/notification") }}')
                .then(res => res.json())
                .then(data => {
                    if (data && data.time !== lastTime) {
                        lastTime = data.time;
                        showNotification(data);
                    }
                });
        }

        function showNotification(data) {
            const box = document.getElementById('notification');
            const icon = document.getElementById('notif-icon');
            const student = document.getElementById('notif-student');
            const message = document.getElementById('notif-message');
            const time = document.getElementById('notif-time');

            // Set content
            student.textContent = data.student;
            message.textContent = data.message;
            time.textContent = data.time;

            // Set color and icon based on type
            box.className = box.className.replace(/bg-\S+/, '');
            if (data.type === 'success') {
                box.classList.add('bg-green-500');
                icon.textContent = '✅';
            } else if (data.type === 'info') {
                box.classList.add('bg-blue-500');
                icon.textContent = '🕐';
            } else if (data.type === 'warning') {
                box.classList.add('bg-yellow-500');
                icon.textContent = '⚠️';
            }

            // Show notification
            box.classList.remove('hidden');

            // Hide after 5 seconds
            setTimeout(() => {
                box.classList.add('hidden');
            }, 5000);
        }

        // Poll every 3 seconds
        setInterval(checkNotification, 3000);
    </script>
</x-admin-layout>