<?php

namespace App\Http\Livewire;

use App\Models\Atendimento;
use Livewire\Component;

class KanbanComponent extends Component
{
    public function render()
    {
        $status = [
                'P' => [
                    'title' => "Pendentes",
                    'atentimentos' => Atendimento::where('status_id', "P")->paginate(10),
                    'class' => "info"
                ],

                'A' => [
                    'title' => "Em Atendimentos",
                    'atentimentos' => Atendimento::where('status_id', "A")->paginate(10),
                    'class' => "primary"
                ],

                'S' => [
                    'title' => "Sucesso",
                    'atentimentos' => Atendimento::where('status_id', "S")->paginate(10),
                    'class' => "success"
                ],

                'I' => [
                    'title' => "Insucesso",
                    'atentimentos' => Atendimento::where('status_id', "I")->paginate(10),
                    'class' => "danger"
                ],
            ];
        //dd($status);
        return view('livewire.kanban-component', compact('status'));
    }
}
