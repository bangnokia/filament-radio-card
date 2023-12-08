@php
    use Filament\Tables\Columns\IconColumn\IconColumnSize;
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $gridDirection = $getGridDirection();
        $id = $getId();
        $isDisabled = $isDisabled();
        $statePath = $getStatePath();
        $isInline = $isInline();
    @endphp

    <x-filament::grid
            :default="$getColumns('default')"
            :sm="$getColumns('sm')"
            :md="$getColumns('md')"
            :lg="$getColumns('lg')"
            :xl="$getColumns('xl')"
            :two-xl="$getColumns('2xl')"
            :is-grid="! $isInline"
            :direction="$gridDirection"
            :attributes="
                \Filament\Support\prepare_inherited_attributes($attributes)
                    ->merge($getExtraAttributes(), escape: false)
                    ->class([
                        'fi-fo-radio gap-4',
                        '-mt-4' => (! $isInline),
                        'flex items-stretch flex-wrap' => $isInline
                    ])
            "
    >
        @foreach ($getOptions() as $value => $label)
            @php
                $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $label);
            @endphp

            <div
                    @class([
                        'break-inside-avoid pt-4' => (! $isInline),
                    ])
            >
                <label class="flex w-full items-stretch gap-x-3 focus-within:ring-primary-600">
                    <input
                            @disabled($shouldOptionBeDisabled)
                            id="{{ $id }}-{{ $value }}"
                            name="{{ $id }}"
                            type="radio"
                            value="{{ $value }}"
                            wire:loading.attr="disabled"
                    {{ $applyStateBindingModifiers('wire:model') }}="{{ $statePath }}"
                    {{
                        $getExtraInputAttributeBag()
                            ->class([
                                'peer hidden'
                            ])
                    }}
                    />

                    <div @class([
                            "px-4 py-2 w-full items-center justify-center grid place-items-center text-sm leading-6 rounded-lg",
                            "ring-1 ring-gray-200 dark:ring-gray-700 peer-checked:ring-2 peer-checked:[--tw-ring-color:rgba(var(--primary-600),1)]",
                            "peer-disabled:bg-gray-100/50 dark:peer-disabled:bg-gray-700/50 peer-disabled:ring-0 peer-disabled:cursor-not-allowed",
                        ])
                    >
                        @if ($icon = $getIcon($value))
                            @php
                                $color = $getColor($value) ?? 'gray';
                                $size = $getSize() ?? IconColumnSize::Large;
                            @endphp

                            <x-filament::icon
                                    :icon="$icon"
                                    @class([
                                        'fi-ta-icon-item mx-auto',
                                        match ($size) {
                                            IconColumnSize::ExtraSmall, 'xs' => 'fi-ta-icon-item-size-xs h-3 w-3',
                                            IconColumnSize::Small, 'sm' => 'fi-ta-icon-item-size-sm h-4 w-4',
                                            IconColumnSize::Medium, 'md' => 'fi-ta-icon-item-size-md h-5 w-5',
                                            IconColumnSize::Large, 'lg' => 'fi-ta-icon-item-size-lg h-6 w-6',
                                            IconColumnSize::ExtraLarge, 'xl' => 'fi-ta-icon-item-size-xl h-7 w-7',
                                            IconColumnSize::TwoExtraLarge, '2xl' => 'fi-ta-icon-item-size-2xl h-8 w-8',
                                            default => $size,
                                        },
                                        match ($color) {
                                            'gray' => 'fi-color-gray text-gray-400 dark:text-gray-500',
                                            default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                                        },
                                    ])
                                    @style([
                                        \Filament\Support\get_color_css_variables(
                                            $color,
                                            shades: [400, 500],
                                        ) => $color !== 'gray',
                                    ])
                            />
                        @endif

                        <span class="font-medium text-gray-950 dark:text-white text-center">{{ $label }}</span>

                        @if ($hasDescription($value))
                            <p class="text-gray-500 dark:text-gray-400 text-xs">
                                {{ $getDescription($value) }}
                            </p>
                        @endif
                    </div>
                </label>
            </div>
        @endforeach
    </x-filament::grid>
</x-dynamic-component>
