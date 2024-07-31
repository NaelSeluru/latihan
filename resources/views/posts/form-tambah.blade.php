<x-app-layout>
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f0f0;">
    <div style="background-color: #d3d3d3; padding: 20px; border-radius: 10px; width: 300px;">
        {{-- Judul form --}}
        <h2 style="text-align: center;">Tambah Data</h2>

        {{-- Menampilkan error jika ada --}}
        @if ($errors->any())
            <div style="color: red;">
                @foreach ($errors->all() as $error)
                @endforeach
            </div>
        @endif

        {{-- Form untuk menambah data baru --}}
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            {{-- Input untuk nama --}}
            <div style="margin-bottom: 15px;">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukan Nama" value="{{ old('nama') }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('nama')
                    <div style="color: red;">Masukan Nama</div>
                @enderror
            </div>

            {{-- Input untuk TTL --}}
            <div style="margin-bottom: 15px;">
                <label for="ttl">TTL:</label>
                <input type="text" id="ttl" name="ttl" placeholder="Masukan TTL" value="{{ old('ttl') }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('ttl')
                    <div style="color: red;">Masukan TTL</div>
                @enderror
            </div>

            {{-- Input untuk sekolah --}}
            <div style="margin-bottom: 15px;">
                <label for="sekolah">Sekolah:</label>
                <input type="text" id="sekolah" name="sekolah" placeholder="Masukan Sekolah" value="{{ old('sekolah') }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('sekolah')
                    <div style="color: red;">Masukan Sekolah</div>
                @enderror
            </div>

            {{-- Input untuk keterangan --}}
            <div style="margin-bottom: 15px;">
                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan" placeholder="Masukan Keterangan" value="{{ old('keterangan') }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('keterangan')
                    <div style="color: red;">Masukan Keterangan</div>
                @enderror
            </div>
            <div style="display: flex; justify-content: space-between;">
                <a href="/" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-md">Batal</a>
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>