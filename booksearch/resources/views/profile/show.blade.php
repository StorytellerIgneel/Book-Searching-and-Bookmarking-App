<x-layout>
    <x-header>Your Profile</x-header>

    <div class="max-w-2xl mx-auto mt-6 bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center space-x-6 mb-6">
            @if($user->profile_image_link && file_exists(public_path($user->profile_image_link)))
                <img src="{{ asset($user->profile_image_link) }}" alt="Profile picture" class="w-24 h-24 rounded-full object-cover">
            @else
                <svg class="w-24 h-24 text-gray-300 rounded-full bg-gray-100" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            @endif

            <div>
                <p class="text-gray-600">Name: {{ $user->username }}</p>
                <p class="text-gray-600">Email: {{ $user->email }}</p>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <p class="text-sm text-gray-500">Date of Birth</p>
                    <p class="text-gray-800">{{ $user->date_of_birth ? date('d M Y', strtotime($user->date_of_birth)) : 'Not provided' }}</p>
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-gray-500">Phone Number</p>
                    <p class="text-gray-800">{{ $user->phone ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                Edit Profile
            </a>
        </div>
    </div>
</x-layout>