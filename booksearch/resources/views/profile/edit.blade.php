<x-layout>
    <x-header>Update Profile</x-header>
    <div class="max-w-xl mx-auto p-8 border border-gray-200 rounded-lg shadow-sm bg-white mt-4">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <x-forms.input                     
                type="email"
                name="email"  
                label="Email"
                placeholder="name@gmail.com" 
                maxlength="100"
            />
            <x-forms.submit-button>Update profile</x-forms.submit-button>
        </form>
    </div>
</x-layout>