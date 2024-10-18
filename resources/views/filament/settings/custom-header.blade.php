<div class="flex items-center justify-between">
    <h1 class="text-xl font-bold">Manage Tasks</h1>

    {{-- Render the "Create New Task" action --}}
    <div>
        @foreach ($this->getHeaderActions() as $action)
            {{-- Customize the button appearance here --}}
            <button 
                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md"
                wire:click.prevent="{{ $action->getLivewireClickHandler() }}" {{-- Prevent default click behavior --}}
            >
                <x-heroicon-o-plus class="w-5 h-5" /> {{-- Use an icon for the '+' sign --}}
            </button>
        @endforeach
    </div>
</div>

{{-- Include preloaded action modals --}}
<x-filament-actions::modals preload />
