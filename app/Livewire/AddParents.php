<?php

namespace App\Livewire;

use Livewire\Component;

class AddParents extends Component
{
    public $name=3;
    public function render()
    {
        return view('livewire.add-parents');
    }
    public function adds()
    {
        return $this->name++;
    }
}
