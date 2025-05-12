<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Overview</h1>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Documents Card -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-t-4 border-blue-500 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Total Documents</p>
                            <div class="flex items-center">
                                <h2 class="text-3xl font-bold text-gray-800" id="documentCount">0</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-t-4 border-green-500 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Total Users</p>
                            <div class="flex items-center">
                                <h2 class="text-3xl font-bold text-gray-800" id="userCount">0</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Departments Card -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-t-4 border-purple-500 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">Departments</p>
                            <div class="flex items-center">
                                <h2 class="text-3xl font-bold text-gray-800" id="departmentCount">0</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Types Card -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-t-4 border-yellow-500 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium uppercase">File Types</p>
                            <div class="flex items-center">
                                <h2 class="text-3xl font-bold text-gray-800" id="fileTypeCount">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Documents per Department Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 transform transition-all duration-300 hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents per Department</h3>
                    <div class="h-64">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>

                <!-- Documents per File Type Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 transform transition-all duration-300 hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents per File Type</h3>
                    <div class="h-64">
                        <canvas id="fileTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
                <div class="overflow-x-auto">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Placeholder for recent activity -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="4">No recent activity</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Animation and Charts Script -->
    <script>
        // Counter animation function
        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            const duration = 1500; // Animation duration in milliseconds
            const frameDuration = 1000 / 60; // 60fps
            const totalFrames = Math.round(duration / frameDuration);
            let frame = 0;
            const initialValue = 0;
            const valueIncrement = (targetValue - initialValue) / totalFrames;
            
            const counter = setInterval(() => {
                frame++;
                const currentValue = Math.round(initialValue + (valueIncrement * frame));
                element.textContent = currentValue;
                
                if (frame === totalFrames) {
                    clearInterval(counter);
                    element.textContent = targetValue; // Ensure final value is exact
                }
            }, frameDuration);
        }

        // Initialize counters with animation
        document.addEventListener('DOMContentLoaded', function() {
            // Animate counters
            animateCounter('documentCount', {{ $documentCount }});
            animateCounter('userCount', {{ $userCount }});
            animateCounter('departmentCount', {{ $departmentCount }});
            animateCounter('fileTypeCount', {{ $fileTypeCount }});
            
            // Department Chart
            const departmentCtx = document.getElementById('departmentChart').getContext('2d');
            const departmentData = {!! json_encode($documentsPerDepartment) !!};
            
            new Chart(departmentCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(departmentData),
                    datasets: [{
                        label: 'Documents',
                        data: Object.values(departmentData),
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.6)',
                            'rgba(79, 70, 229, 0.6)',
                            'rgba(67, 56, 202, 0.6)',
                            'rgba(55, 48, 163, 0.6)',
                            'rgba(49, 46, 129, 0.6)',
                        ],
                        borderColor: [
                            'rgba(99, 102, 241, 1)',
                            'rgba(79, 70, 229, 1)',
                            'rgba(67, 56, 202, 1)',
                            'rgba(55, 48, 163, 1)',
                            'rgba(49, 46, 129, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
            
            // File Type Chart
            const fileTypeCtx = document.getElementById('fileTypeChart').getContext('2d');
            const fileTypeData = {!! json_encode($documentsPerFileType) !!};
            
            new Chart(fileTypeCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(fileTypeData),
                    datasets: [{
                        label: 'Documents',
                        data: Object.values(fileTypeData),
                        backgroundColor: [
                            'rgba(245, 158, 11, 0.6)',
                            'rgba(217, 119, 6, 0.6)',
                            'rgba(180, 83, 9, 0.6)',
                            'rgba(146, 64, 14, 0.6)',
                            'rgba(120, 53, 15, 0.6)',
                        ],
                        borderColor: [
                            'rgba(245, 158, 11, 1)',
                            'rgba(217, 119, 6, 1)',
                            'rgba(180, 83, 9, 1)',
                            'rgba(146, 64, 14, 1)',
                            'rgba(120, 53, 15, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 2000,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
