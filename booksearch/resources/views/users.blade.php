<x-layout>
    <x-header>User list</x-header>
    <div class="container mx-auto px-4 py-8">
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th>Is_admin</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <!-- Show user's profile is available, show default profile image if not -->
                                    @if($user->profile_image_link && file_exists(public_path($user->profile_image_link)))
                                        <img src="{{ asset($user->profile_image_link) }}" alt="Profile picture" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <svg class="h-10 w-10 text-gray-300 rounded-full bg-gray-100" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="td">
                                {{ $user->username }}
                            </td>
                            <td class="td">
                                {{ $user->email }}
                            </td>
                            <td class="td">
                                {{ $user->date_of_birth ? date('d M Y', strtotime($user->date_of_birth)) : 'Not provided' }}
                            </td>
                            <td class="td">
                                {{ $user->phone ?? 'Not provided' }}
                            </td>
                            <td class="td">
                                <form action="{{ route('users.toggle-admin', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="px-3 py-1 text-sm rounded-full {{ $user->is_admin ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} hover:bg-opacity-75 transition-colors">
                                        {{ $user->is_admin ? 'Admin' : 'Not Admin' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-layout>

<style>
    th {
        padding-left: 1.5rem;  
        padding-right: 1.5rem;
        padding-top: 0.75rem;  
        padding-bottom: 0.75rem;
        text-align: left;      
        font-size: 0.75rem; 
        font-weight: 500;       
        color: #6B7280;      
        text-transform: uppercase;
        letter-spacing: 0.05em; 
    }
    .td {
        padding-left: 1.5rem;       
        padding-right: 1.5rem;
        padding-top: 1rem;        
        padding-bottom: 1rem;
        white-space: nowrap;        
        font-size: 0.875rem;        
        color: #111827;            
    }
</style>
