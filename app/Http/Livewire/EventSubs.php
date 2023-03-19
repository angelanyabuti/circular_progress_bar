<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EventSubscription;

class EventSubs extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Event', 'event_id'),
            Column::make('Customer', 'user_id'),
            Column::make('Event Date', 'event_date'),
        ];
    }

    public function query(): Builder
    {
        return EventSubscription::query();
    }

    public function configure(): void
    {
        // TODO: Implement configure() method.
    }
}
