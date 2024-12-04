<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Blog Posts</h2>
                        @auth
                            <a href="{{ route('blogs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create New Post
                            </a>
                        @endauth
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($blogs as $blog)
                            <div class="bg-white rounded-lg border shadow-sm">
                                @if($blog->foto)
                                    <img src="{{ asset('storage/public/blog-images//' . $blog->foto) }}" alt="{{ $blog->judul }}" class="w-full h-48 object-cover rounded-t-lg">
                                @endif
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">{{ $blog->judul }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($blog->isi, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">By {{ $blog->pembuat }}</span>
                                        <a href="{{ route('blogs.show', $blog) }}" class="text-blue-500 hover:text-blue-700">Read more</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
