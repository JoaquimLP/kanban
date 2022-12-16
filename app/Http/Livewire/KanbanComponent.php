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

    public function updateAtendimento($status, $atendimento_id)
    {
        if(isset($status) && isset($atendimento_id)){
            $status = str_replace("kanban-", "", $status);
            $atendimento = Atendimento::find($atendimento_id);

            if (in_array($atendimento->status_id, ["S", "I"])) {
                $this->dispatchBrowserEvent('response', [
                    'text' => "O atendimento selecionado já foi finalizado",
                    'status' => "error"
                ]);
                return;
            }

            if ($atendimento->status_id == "A" && $status == "P") {
                $this->dispatchBrowserEvent('response', [
                    'text' => "O atendimento não pode retorna a um card Anterior",
                    'status' => "error"
                ]);
                return;
            }
            dd($status, $atendimento);
        }

    }
}
