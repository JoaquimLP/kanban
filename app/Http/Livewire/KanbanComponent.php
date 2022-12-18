<?php

namespace App\Http\Livewire;

use App\Models\Atendimento;
use Livewire\Component;

class KanbanComponent extends Component
{
    public $atendimendoId;
    public $showAtendimento;
    public $pendente = 10, $em_atendimento = 10, $sucesso = 10, $insucesso = 10;

    public function loadMore($id)
    {
        switch ($id) {
            case 'P':
                $this->pendente += 10;
                $this->em_atendimento = 10;
                $this->sucesso = 10;
                $this->insucesso = 10;
            break;

            case 'A':
                $this->pendente = 10;
                $this->em_atendimento += 10;
                $this->sucesso = 10;
                $this->insucesso = 10;
            break;

            case 'S':
                $this->pendente = 10;
                $this->em_atendimento = 10;
                $this->sucesso += 10;
                $this->insucesso = 10;
            break;

            case 'I':
                $this->pendente = 10;
                $this->em_atendimento = 10;
                $this->sucesso = 10;
                $this->insucesso += 10;
            break;

            default:
                # code...
                break;
        }
    }

    public function render()
    {
        $status = [
                'P' => [
                    'title' => "Pendentes",
                    'atentimentos' => Atendimento::where('status_id', "P")->orderBy('updated_at', "DESC")->paginate($this->pendente),
                    'class' => "info"
                ],

                'A' => [
                    'title' => "Em Atendimentos",
                    'atentimentos' => Atendimento::where('status_id', "A")->orderBy('updated_at', "DESC")->paginate($this->em_atendimento),
                    'class' => "primary"
                ],

                'S' => [
                    'title' => "Sucesso",
                    'atentimentos' => Atendimento::where('status_id', "S")->orderBy('updated_at', "DESC")->paginate($this->sucesso),
                    'class' => "success"
                ],

                'I' => [
                    'title' => "Insucesso",
                    'atentimentos' => Atendimento::where('status_id', "I")->orderBy('updated_at', "DESC")->paginate($this->insucesso),
                    'class' => "danger"
                ],
            ];

        return view('livewire.kanban-component', compact('status'));
    }

    public function showAtendimento($atendimento_id)
    {
        $atendimento = Atendimento::find($atendimento_id);

        if (!$atendimento) {
            $this->dispatchBrowserEvent('response', [
                'text' => "O atendimento não encontrado",
                'status' => "error"
            ]);

            return;
        }

        $this->showAtendimento = $atendimento;

        $this->dispatchBrowserEvent('open-modal', [
            'id' => "modal-show",
        ]);
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
            }elseif ($atendimento->status_id == "P" && $status == "A") {
                $atendimento->status_id = "A";
                $atendimento->save();
                $this->dispatchBrowserEvent('response', [
                    'text' => "Atendimento iniciado com sucesso.",
                    'status' => "success"
                ]);
                return;
            }elseif ($atendimento->status_id == "P" && $status == "S") {
                $atendimento->status_id = "S";
                $atendimento->save();
                $this->dispatchBrowserEvent('response', [
                    'text' => "Atendimento iniciado com sucesso.",
                    'status' => "success"
                ]);
                return;
            }elseif ($atendimento->status_id == "P" && $status == "I") {
                $atendimento->status_id = "I";
                $atendimento->save();
                $this->dispatchBrowserEvent('response', [
                    'text' => "Atendimento iniciado com Incusseo.",
                    'status' => "success"
                ]);
                return;
            }elseif ($atendimento->status_id == "A" && $status == "S") {
                $atendimento->status_id = "S";
                $atendimento->save();
                $this->dispatchBrowserEvent('response', [
                    'text' => "Atendimento finalizado como sucesso.",
                    'status' => "success"
                ]);
                return;
            }elseif ($atendimento->status_id == "A" && $status == "I") {
                $atendimento->status_id = "I";
                $atendimento->save();
                $this->dispatchBrowserEvent('response', [
                    'text' => "Atendimento finalizado como Incusseo.",
                    'status' => "success"
                ]);
                return;
            }

        }
    }

    public function closeModal()
    {
        $this->showAtendimento = "";
        $this->dispatchBrowserEvent('close-modal', [
            'id' => "modal-show",
        ]);
    }
}
