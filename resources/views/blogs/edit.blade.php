<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('blogs.show', $blog) }}" class="text-blue-500 hover:text-blue-700">← Back to Post</a>
                    </div>

                    <h1 class="text-2xl font-bold mb-6">Edit Blog Post</h1>

                    <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                            <input type="text" name="judul" id="judul" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror" 
                                value="{{ old('judul', $blog->judul) }}" required>
                            @error('judul')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="isi" class="block text-gray-700 text-sm font-bold mb-2">Isi</label>
                            <textarea name="isi" id="isi" rows="6" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('isi') border-red-500 @enderror" 
                                required>{{ old('isi', $blog->isi) }}</textarea>
                            @error('isi')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        @if($blog->foto)
                            <div class="mb-4">
                                <p class="block text-gray-700 text-sm font-bold mb-2">Current Photo</p>
                                <img src="{{ asset('storage/public/blog-images/' . $blog->foto) }}" alt="{{ $blog->judul }}" class="w-48 h-48 object-cover rounded">
                            </div>
                        @endif

                        <div class="mb-6">
                            <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">New Photo (Optional)</label>
                            <input type="file" name="foto" id="foto" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror"
                                accept="image/*">
                            @error('foto')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
