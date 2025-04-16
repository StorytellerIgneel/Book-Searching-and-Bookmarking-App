<x-layout>
    <x-header>Your Profile</x-header>

    <div class="max-w-2xl mx-auto mt-6 bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center space-x-6 mb-6">
            @if($user->profile_image_link)
                <img src="{{ asset($user->profile_image_link) }}" alt="Profile picture" class="w-24 h-24 rounded-full object-cover">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-2xl text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                </div>
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