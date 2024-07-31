<x-app-layout>
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f0f0;">
    <div style="background-color: #d3d3d3; padding: 20px; border-radius: 10px; width: 300px;">
        <h2 style="text-align: center;">Edit Data</h2>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            @endforeach
        @endif            
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Input untuk nama -->
            <div style="margin-bottom: 15px;">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ $post->nama }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('nama')
                    <div style="color: red;">Masukan Nama</div>
                @enderror
            </div>
            
            <!-- Input untuk TTL -->
            <div style="margin-bottom: 15px;">
                <label for="ttl">TTL:</label>
                <input type="text" id="ttl" name="ttl" value="{{ $post->ttl }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('ttl')
                    <div style="color: red;">Masukan TTL</div>
                @enderror
            </div>
            
            <!-- Input untuk sekolah -->
            <div style="margin-bottom: 15px;">
                <label for="sekolah">Sekolah:</label>
                <input type="text" id="sekolah" name="sekolah" value="{{ $post->sekolah }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                @error('sekolah')
                    <div style="color: red;">Masukan Sekolah</div>
                @enderror
            </div>
            
            <!-- Input untuk keterangan -->
            <div style="margin-bottom: 15px;">
                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan" value="{{ $post->keterangan }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
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