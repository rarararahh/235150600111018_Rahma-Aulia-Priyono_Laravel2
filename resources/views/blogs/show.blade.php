<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('blogs.index') }}" class="text-blue-500 hover:text-blue-700">← Back to Posts</a>
                    </div>

                    @if($blog->foto)
                        <img src="{{ asset('storage/public/blog-images//' . $blog->foto) }}" alt="{{ $blog->judul }}" class="w-full max-h-96 object-cover rounded-lg mb-6">
                    @endif

                    <h1 class="text-3xl font-bold mb-4">{{ $blog->judul }}</h1>
                    
                    <div class="flex items-center text-gray-500 mb-6">
                        <span>By {{ $blog->pembuat }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $blog->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="prose max-w-none mb-6">
                        {!! nl2br(e($blog->isi)) !!}
                    </div>

                    @auth
                        @if(Auth::user()->name === $blog->pembuat)
                            <div class="flex gap-4">
                                <a href="{{ route('blogs.edit', $blog) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Post
                                </a>
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this post?')">
                                        Delete Post
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
