<form method="POST" action="{{ route('profile.upload-picture') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <x-input-label for="profile_picture" :value="__('Upload Profile Picture')" />
        <input type="file" id="profile_picture" class="block mt-1 w-full" name="profile_picture" accept=".png, .jpg, .jpeg" required />
        @error('profile_picture')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="flex items-left mt-4">
        <x-primary-button>
            {{ __('Upload') }}
        </x-primary-button>
    </div>
</form>