<x-app-layout>
    <x-slot name="header">
            {{ __('Dashboard') }}
        </h2>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- General Information Content -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4">Welcome!</h3>
                <p class="text-gray-700 mb-4">
                    This application helps you track and manage your job applications. You can start using the application with the following steps:
                </p>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li><strong>Add New Job Application:</strong> You can add new applications for positions you've applied to.</li>
                    <li><strong>Manage Your Applications:</strong> You can update the status of your applications, add notes, and review application details.</li>
                    <li><strong>Status Tracking:</strong> You can track the status of your applications (pending, invited for interview, rejected, offer received).</li>
                    <li><strong>Export to Excel:</strong> You can export all your applications in Excel format.</li>
                </ul>
                <p class="text-gray-700">
                    You can get an overview of your applications from the statistics below. Also, you can use the relevant buttons to add new applications or manage your existing applications.
                </p>

                <!-- Moved buttons here -->
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('job-applications.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-edit"></i> Manage Job Applications
                    </a>
                    
                    <a href="{{ route('job-applications.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus"></i> Add New Job Application
                    </a>
                </div>
            </div>

            <!-- Response Rate Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                        <i class="fas fa-percentage text-white fa-2x"></i>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $responseRate }}%</h4>
                        <div class="text-gray-500">Response Rate</div>
                    </div>
                </div>
            </div>

            <!-- Daily Activity Chart -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4">Last 7 Days Activity</h3>
                <div id="dailyStats"></div>
            </div>

            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pending Applications -->
                <a href="{{ route('job-applications.index', ['status' => 'pending']) }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex items-center justify-center w-full h-48 md:h-auto md:w-48 bg-blue-200 rounded-t-lg p-4">
                        <i class="fas fa-clock fa-3x text-blue-600"></i>
                    </div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Pending Applications</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $pendingCount }} Applications</p>
                    </div>
                </a>

                <!-- Invited for Interview Applications -->
                <a href="{{ route('job-applications.index', ['status' => 'interview']) }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex items-center justify-center w-full h-48 md:h-auto md:w-48 bg-green-200 rounded-t-lg p-4">
                        <i class="fas fa-user-check fa-3x text-green-600"></i>
                    </div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Invited for Interview</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $interviewCount }} Applications</p>
                    </div>
                </a>

                <!-- Rejected Applications -->
                <a href="{{ route('job-applications.index', ['status' => 'rejected']) }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex items-center justify-center w-full h-48 md:h-auto md:w-48 bg-red-200 rounded-t-lg p-4">
                        <i class="fas fa-times-circle fa-3x text-red-600"></i>
                    </div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Rejected Applications</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $rejectedCount }} Applications</p>
                    </div>
                </a>

                <!-- Offer Received Applications -->
                <a href="{{ route('job-applications.index', ['status' => 'offered']) }}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex items-center justify-center w-full h-48 md:h-auto md:w-48 bg-yellow-200 rounded-t-lg p-4">
                        <i class="fas fa-trophy fa-3x text-black"></i>
                    </div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Offer Received</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $offeredCount }} Applications</p>
                    </div>
                </a>
            </div>

            <!-- Monthly Statistics Chart -->
            <div class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Monthly Application Statistics</h3>
                <div id="monthlyStats"></div>
            </div>

        </div>
    </div>

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script>
        var options = {
            series: [{
                name: 'Applications',
                data: {!! json_encode($monthlyData) !!}
            }],
            chart: {
                type: 'area',
                height: 350,
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Application Trends',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: {!! json_encode($monthlyLabels) !!},
            },
            yaxis: {
                title: {
                    text: 'Number of Applications'
                },
                min: 0,
                forceNiceScale: true,
                labels: {
                    formatter: function (value) {
                        return Math.round(value);
                    }
                }
            },
            colors: ['#4f46e5'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return value + ' Applications';
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthlyStats"), options);
        chart.render();

        // Daily Activity Chart
        var dailyOptions = {
            series: [{
                name: 'Applications',
                data: {!! json_encode($dailyData) !!}
            }],
            chart: {
                type: 'bar',
                height: 250
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: {!! json_encode($dailyLabels) !!},
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                tooltip: {
                    enabled: false,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                }
            },
            colors: ['#4f46e5']
        };

        var dailyChart = new ApexCharts(document.querySelector("#dailyStats"), dailyOptions);
        dailyChart.render();
    </script>
</x-app-layout>
