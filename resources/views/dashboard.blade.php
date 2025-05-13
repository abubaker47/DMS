<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10 opacity-0 transform translate-y-4" x-data x-init="setTimeout(() => { $el.classList.add('opacity-100', 'translate-y-0', 'transition-all', 'duration-700', 'ease-out') }, 100)">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Dashboard Overview</h1>
                <div class="text-right">
                    <p class="text-sm text-gray-600" x-data="clock()" x-init="startClock()" x-text="time"></p>
                    <p class="text-xs text-gray-500">{{ now()->format('l, F j, Y') }}</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 200)" x-cloak>
                <!-- Stat Card Component -->
                <div class="bg-white shadow-lg rounded-2xl p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" x-show="shown" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="backdrop-filter: blur(20px);">
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 400)" x-cloak>
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" x-show="shown" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="backdrop-filter: blur(20px);">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents per Department</h3>
                    <div class="h-64">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" x-show="shown" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="backdrop-filter: blur(20px);">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Documents per File Type</h3>
                    <div class="h-64">
                        <canvas id="fileTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 transform transition-all duration-300 hover:shadow-xl" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 600)" x-show="shown" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="backdrop-filter: blur(20px);">
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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .chart-container { transition: transform 0.3s ease-in-out; }
        .chart-container:hover { transform: scale(1.02); }
    </style>

    <!-- Animation and Charts Script -->
    <script>
        function clock() {
            return {
                time: new Date().toLocaleTimeString(),
                startClock() {
                    setInterval(() => {
                        this.time = new Date().toLocaleTimeString();
                    }, 1000);
                }
            };
        }
        // Counter animation function
        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            const duration = 2000; // Animation duration in milliseconds
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
            const fromDepartmentData = {!! json_encode($documentsFromDepartment) !!};
            const toDepartmentData = {!! json_encode($documentsToDepartment) !!};
            const departments = [...new Set([...Object.keys(fromDepartmentData), ...Object.keys(toDepartmentData)])];

            new Chart(departmentCtx, {
                type: 'bar',
                data: {
                    labels: departments,
                    datasets: [{
                        label: 'Documents Sent',
                        data: departments.map(dept => fromDepartmentData[dept] || 0),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    },
                    {
                        label: 'Documents Received',
                        data: departments.map(dept => toDepartmentData[dept] || 0),
                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        onComplete: function() {
                            const ctx = this.ctx;
                            ctx.save();
                            ctx.globalCompositeOperation = 'destination-over';
                            ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
                            ctx.fillRect(0, 0, this.width, this.height);
                            ctx.restore();
                        },
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
                        onComplete: function() {
                            const ctx = this.ctx;
                            ctx.save();
                            ctx.globalCompositeOperation = 'destination-over';
                            ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
                            ctx.fillRect(0, 0, this.width, this.height);
                            ctx.restore();
                        },
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
