<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Job Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('job-applications.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="position" class="block text-gray-700">Position Name</label>
                        <input type="text" name="position" id="position" class="form-control w-full" required maxlength="100" placeholder="Position name">
                    </div>

                    <div class="form-group mb-4">
                        <label for="company_name" class="block text-gray-700">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control w-full" required maxlength="100" placeholder="Company name">
                    </div>

                    <div class="form-group mb-4">
                        <label for="applied_at" class="block text-gray-700">Application Date</label>
                        <input type="date" name="applied_at" id="applied_at" class="form-control w-full" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="status" class="block text-gray-700">Status</label>
                        <select name="status" id="status" class="form-control w-full">
                            <option value="pending">Pending</option>
                            <option value="interview">Interview Scheduled</option>
                            <option value="rejected">Rejected</option>
                            <option value="offered">Offer Received</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="job_listing_url" class="block text-gray-700">Job Listing URL</label>
                        <input type="url" name="job_listing_url" id="job_listing_url" class="form-control w-full" maxlength="2048" placeholder="Job listing URL">
                    </div>

                    <div class="form-group mb-4">
                        <label for="company_website_url" class="block text-gray-700">Company Website</label>
                        <input type="url" name="company_website_url" id="company_website_url" class="form-control w-full" maxlength="2048" placeholder="Company website">
                    </div>

                    <div class="form-group mb-4">
                        <label for="notes" class="block text-gray-700">Notes</label>
                        <textarea name="notes" id="notes" class="form-control w-full" maxlength="2000" placeholder="Enter your notes here..."></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>