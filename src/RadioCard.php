<?php

namespace BangNokia\FilamentRadioCard;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Support\Concerns\HasColor;
use Filament\Tables\Columns\IconColumn\IconColumnSize;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Closure;

class RadioCard extends Radio
{
    use HasColor;

    protected string|Closure|null $size = null;

    protected string $view = 'filament-radio-card::radio-card';

    protected bool | Closure $isInline = false;

    public function getIcons()
    {
        $options = $this->evaluate($this->options) ?? [];

        $enum = $options;

        if (is_string($enum) && enum_exists($enum)) {
            /* @var \UnitEnum $enum */
            return collect($enum::cases())
                ->when(
                    is_a($enum, \Filament\Support\Contracts\HasIcon::class, allow_string: true),
                    fn(Collection $options) => $options->mapWithKeys(fn($case) => [$case->value ?? $case->name => $case->getIcon()]),
                    fn(Collection $options) => $options->mapWithKeys(fn($case) => [$case->value ?? $case->name => null]),
                )->all();
        }

        if ($options instanceof Arrayable) {
            return $options->toArray();
        }

        return $options;
    }

    public function getGridDirection(): ?string
    {
        return 'row';
    }

    public function getIcon(mixed $option): ?string
    {
        return $this->getIcons()[$option] ?? null;
    }

    public function getSize(): IconColumnSize | string | null
    {
        return $this->evaluate($this->size);
    }
}