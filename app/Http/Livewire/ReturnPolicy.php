<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class ReturnPolicy extends Component
{
    public function render()
    {

        $termsFile = Jetstream::localizedMarkdownPath('return.md');
        return view('livewire.return-policy',[
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);
    }
}
