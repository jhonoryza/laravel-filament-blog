@if ($post->is_markdown)
    <div class="container mx-auto prose-code:bg-gray-200">
        {{ $this->postInfoList }}
    </div>
@else
    <div class="container mx-auto prose-code:text-slate-200">
        {{ $this->postInfoList }}
    </div>
@endif
