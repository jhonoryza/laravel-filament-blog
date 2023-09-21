<div>
    <a href="{{ url()->previous() }}" wire:navigate class="text-xl font-bold text-slate-500 hover:text-rose-500">< Back</a>
    <x-post :post="$post" />
</div>
