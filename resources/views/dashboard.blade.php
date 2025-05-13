<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-10">Dashboard Overview</h1>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Stat Card Component -->
                <div class="bg-white shadow-md rounded-2xl p-6 border-t-4 border-blue-500 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                            <!-- Icon -->
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Documents</p>
                            <h2 class="text-2xl font-bold text-gray-800" id="documentCount">0</h2>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-2xl p-6 border-t-4 border-green-500 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-green-100 text-green-600 rounded-full">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Users</p>
                            <h2 class="text-2xl font-bold text-gray-800" id="userCount">0</h2>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-2xl p-6 border-t-4 border-purple-500 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Departments</p>
                            <h2 class="text-2xl font-bold text-gray-800" id="departmentCount">0</h2>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-2xl p-6 border-t-4 border-yellow-500 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">File Types</p>
                            <h2 class="text-2xl font-bold text-gray-800" id="fileTypeCount">0</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents per Department</h3>
                    <div class="h-64">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents per File Type</h3>
                    <div class="h-64">
                        <canvas id="fileTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-10">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h3>
                <div class="overflow-x-auto">
                    <div class="min-w-full align-middle">
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-500" colspan="4">No recent activity</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js"></script>

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
                            'rgba(255, 99, 132, 0.7)',   // Pink
                            'rgba(54, 162, 235, 0.7)',   // Blue
                            'rgba(255, 206, 86, 0.7)',   // Yellow
                            'rgba(75, 192, 192, 0.7)',   // Teal
                            'rgba(153, 102, 255, 0.7)',  // Purple
                            'rgba(255, 159, 64, 0.7)',   // Orange
                            'rgba(46, 204, 113, 0.7)',   // Green
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(46, 204, 113, 1)',
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        delay: (context) => context.dataIndex * 100,
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
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
                            'rgba(255, 99, 132, 0.8)',   // Pink
                            'rgba(54, 162, 235, 0.8)',   // Blue
                            'rgba(255, 206, 86, 0.8)',   // Yellow
                            'rgba(75, 192, 192, 0.8)',   // Teal
                            'rgba(153, 102, 255, 0.8)',  // Purple
                            'rgba(255, 159, 64, 0.8)',   // Orange
                            'rgba(46, 204, 113, 0.8)',   // Green
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(46, 204, 113, 1)',
                        ],
                        borderWidth: 2,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    },
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 14
                            },
                            displayColors: true,
                            usePointStyle: true
                        }
                    },
                    cutout: '60%',
                    radius: '90%'
                }
            });
        });
    </script>
</x-app-layout>
