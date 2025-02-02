@props([
    'actions',
    'allRecordsCount',
    'allRecordsSelected' => false,
])

<div
    x-data="{
        isOpen: false,
    }"
    x-cloak
    {{ $attributes->class(['relative']) }}
>
    <x-tables::bulk-actions.trigger />

    <div
        x-show="isOpen"
        x-on:click.away="isOpen = false"
        x-transition:enter="transition"
        x-transition:enter-start="-translate-y-1 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="-translate-y-1 opacity-0"
        class="absolute z-10 mt-2 shadow-xl rounded-xl w-52 top-full"
    >
        <ul class="py-1 space-y-1 overflow-hidden bg-white shadow rounded-xl">
            @if (! $allRecordsSelected)
                <x-tables::dropdown.item wire:click="toggleSelectAllTableRecords" icon="heroicon-o-duplicate">
                    {{ __('tables::table.actions.buttons.select_all.label', ['count' => $allRecordsCount]) }}
                </x-tables::dropdown.item>

                <div aria-hidden="true" class="border-t border-gray-200 ml-11"></div>
            @endif

            @foreach($actions as $action)
                <x-tables::dropdown.item
                    :wire:click="'mountTableBulkAction(\'' . $action->getName() . '\')'"
                    :icon="$action->getIcon()"
                    :color="$action->getColor()"
                >
                    {{ $action->getLabel() }}
                </x-tables::dropdown.item>
            @endforeach
        </ul>
    </div>
</div>
