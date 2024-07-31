<x-app-layout>
    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Data Siswa</h2>
            @if ($userPostCount < $maxUploads)
            @if (Auth::user()->role == 'siswa')
                <a href="/form-tambah" class="bg-gray-500 hover:bg-gray-7000 text-white px-4 py-2 rounded-md">Tambah Data</a>
            @else
                <a href="/form-tambah" class="bg-gray-500 hover:bg-gray-7000 text-white px-4 py-2 rounded-md hidden">Tambah Data</a>
            @endif
            @else
                <span class="text-red-500">Anda telah mencapai batas maksimal upload data.</span>
            @endif
        </div>
            @if ($message = Session::get('success'))
            <div id="session-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <span class="block sm:inline">{{ $message }}</span>
            </div>
        @endif
        <div class="grid grid-cols-3 gap-4">
            @if (Auth::user()->role == 'siswa')
            @foreach ($userPosts as $post)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="mb-2">
                    <strong>Nama:</strong> {{ $post->nama }}
                </div>
                <div class="mb-2">
                    <strong>TTL:</strong> {{ $post->ttl }}
                </div>
                <div class="mb-2">
                    <strong>Sekolah:</strong> {{ $post->sekolah }}
                </div>
                <div class="mb-2">
                    <strong>Keterangan:</strong> {{ $post->keterangan }}
                </div>
                <div class="flex justify-between">
                    <a href="/{{$post->id}}/ubah" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded-md">Edit</a>
                </div>
            </div>
            @endforeach
            @else
            @foreach ($publicPosts as $post)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="mb-2">
                    <strong>Nama:</strong> {{ $post->nama }}
                </div>
                <div class="mb-2">
                    <strong>TTL:</strong> {{ $post->ttl }}
                </div>
                <!-- Menampilkan sekolah siswa -->
                <div class="mb-2">
                    <strong>Sekolah:</strong> {{ $post->sekolah }}
                </div>
                <div class="mb-2">
                    <strong>Keterangan:</strong> {{ $post->keterangan }}
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sessionMessage = document.getElementById('session-message');
            if (sessionMessage) {
                setTimeout(() => {
                    sessionMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</x-app-layout>