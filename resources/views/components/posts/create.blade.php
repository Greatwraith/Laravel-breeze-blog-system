@push('style')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endpush

<div class="max-w-7xl p-4 bg-white rounded-lg border">
    <h3 class="text-lg font-semibold mb-4">Add new post</h3>

    {{-- GLOBAL ERROR --}}
    @if ($errors->any())
        <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded">
            Please fix the errors below.
        </div>
    @endif

    <form action="/dashboard" method="POST" id="post-form">
        @csrf

        {{-- TITLE --}}
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">Title</label>
            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                class="w-full p-2 border rounded
                @error('title') border-red-500 bg-red-50 @else border-gray-300 @enderror"
            >
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- CATEGORY --}}
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">Category</label>
            <select
                name="category_id"
                class="w-full p-2 border rounded
                @error('category_id') border-red-500 bg-red-50 @else border-gray-300 @enderror"
            >
                <option value="">Select category</option>
                @foreach (App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- BODY --}}
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">Body</label>

            {{-- HIDDEN TEXTAREA --}}
            <textarea name="body" id="body" class="hidden">{{ old('body') }}</textarea>

            {{-- QUILL EDITOR --}}
            <div
                id="editor"
                class="border rounded min-h-[150px]
                @error('body') border-red-500 bg-red-50 @else border-gray-300 @enderror">
            </div>

            @error('body')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Add new post
        </button>
    </form>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write post body here...',
    });

    // Restore old content
    const oldBody = `{!! old('body') !!}`;
    if (oldBody) {
        quill.root.innerHTML = oldBody;
    }

    const form = document.getElementById('post-form');
    const bodyInput = document.getElementById('body');

    form.addEventListener('submit', function () {
        bodyInput.value = quill.root.innerHTML;
    });
</script>
@endpush
