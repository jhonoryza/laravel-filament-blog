@push('css')
    <style>
        .code-block-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-between;
            width: 100%;
            height: 100%;
            background-color: #f7f7f7;
        }

        .code-header {
            display: flex;
            flex-direction: row;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            background-color: #f1f1f1;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .language-label {
            font-size: 0.75rem;
            color: #555;
            padding: 5px;
        }

        .copy-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 0.75rem;
            color: #333;
            padding: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .copy-btn:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
@push('js')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script>
        function copyToClipboard(button) {
            var codeBlock = button.closest('.code-block-container').querySelector('pre');

            var textArea = document.createElement('textarea');
            textArea.value = codeBlock.innerText;
            document.body.appendChild(textArea);

            textArea.select();
            document.execCommand('copy');

            document.body.removeChild(textArea);
        }

    </script>
@endpush

<div class="container mx-auto"
>
    <div class="flex flex-col gap-6">

        <x-buttons.back />

        <!-- title -->
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
            {{ $post->title }}
        </h1>
        <!-- end title -->

        <!-- image -->
        <img src="{{ $post->getThumbnailImageUrl() }}"
             class="object-contain rounded-xl h-64 w-full bg-transparent"
             alt="{{ $post->title }}"
        >
        <!-- end image -->

        <!-- Tag -->
        <div class="flex flex-wrap gap-2">
            @foreach ($post->categories ?? [] as $category)
                <span class=" border border-indigo-200 rounded-lg shadow-xl
                        text-sm text-slate-700 font-medium py-1 px-2"
                >
                        {{ $category->name }}
                    </span>
            @endforeach
        </div>
        <!-- end Tag -->

        <!-- content -->
        <div @class([
                'prose',
                'prose-sm prose-p:max-w-sm prose-h1:max-w-sm prose-h2:max-w-sm',
                'prose-ul:max-w-sm prose-li:max-w-sm prose-table:max-w-sm',
                'prose-thead:max-w-sm prose-tbody:max-w-sm prose-pre:max-w-sm',
                'prose-code:max-w-sm prose-pre:w-full prose-pre:my-0',
                'prose-a:break-words',
                'prose-code:bg-gray-200' => $post->is_markdown == true,
                'prose-code:text-slate-200'=> $post->is_markdown == false,
                ])
        >
            {!! $content !!}
        </div>
        <!-- end content -->

        <x-buttons.back />
    </div>
</div>
