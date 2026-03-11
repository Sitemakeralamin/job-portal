<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">

                {{-- Total Jobs Card --}}
                <div class="overflow-hidden transition-all bg-white border-l-4 border-blue-500 shadow-sm sm:rounded-lg hover:shadow-xl">
                    <div class="flex items-center justify-between p-6">
                        <div>
                            <p class="text-sm font-medium tracking-wider text-gray-500 uppercase">
                                Total Jobs
                            </p>
                            <h3 class="mt-2 text-4xl font-bold text-gray-900">
                                {{ $totalJobs }}
                            </h3>
                            <a href="{{ route('jobs.index') }}" class="inline-block mt-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                                View All Jobs <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-full">
                            <i class="text-4xl text-blue-600 bi bi-briefcase-fill"></i>
                        </div>
                    </div>
                </div>

                {{-- Total Applications Card --}}
                <div class="overflow-hidden transition-all bg-white border-l-4 border-green-500 shadow-sm sm:rounded-lg hover:shadow-xl">
                    <div class="flex items-center justify-between p-6">
                        <div>
                            <p class="text-sm font-medium tracking-wider text-gray-500 uppercase">
                                Total Applications
                            </p>
                            <h3 class="mt-2 text-4xl font-bold text-gray-900">
                                {{ $totalApplications }}
                            </h3>
                             <a href="{{ route('applications.index') }}" class="inline-block mt-2 text-sm font-medium text-green-600 hover:text-green-800">
                                View Applications <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="p-4 bg-green-100 rounded-full">
                            <i class="text-4xl text-green-600 bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>

            </div>

            {{-- You can keep other content here if needed --}}
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-2 text-lg font-semibold">Quick Overview</h3>
                    <p class="text-gray-600">
                        Welcome back! You have <span class="font-bold text-green-600">{{ $totalApplications }}</span> total applications across <span class="font-bold text-blue-600">{{ $totalJobs }}</span> job listings.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
