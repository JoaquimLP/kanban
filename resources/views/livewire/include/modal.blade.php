<div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="modal-show" tabindex="-1" aria-labelledby="modal-showLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-showLabel">#{{$showAtendimento->id ?? ""}}</h5>
          <button type="button" class="btn-close" wire:click.prevnt="closeModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <p>Cliente: <strong>{{$showAtendimento->nome ?? "Não Informado"}}</strong></p>
                </div>
                <div class="col-5">
                    <p>Celular: <strong>{{mask_phone($showAtendimento->celular ?? "")}}</strong></p>
                </div>
                <div class="col-7">
                    <p>email: <strong>{{$showAtendimento->email ?? ""}}</strong></p>
                </div>
                <div class="col-4">
                    <p>Origem: <strong>{{$showAtendimento->origem ?? ""}}</strong></p>
                </div>
                <div class="col-6">
                    <p>Situação: <strong>{{label_status($showAtendimento->status_id ?? "")}}</strong></p>
                </div>
                <div class="col-12">
                    <p>Observação: <br> {{$showAtendimento->observacao ?? ""}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>Responsável:</p>
                    <p class="mt-1 mx-3">
                        @if (isset($showAtendimento->usuario))
                            <img src="{{ asset('img/'.$showAtendimento->usuario->avatar.'.jpg') }}" alt="user-img" class="avatar-xs rounded-circle me-1">
                            <span class="align-middle">{{$showAtendimento->usuario->name}}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" wire:click.prevnt="closeModal()">Fechar</button>
        </div>
      </div>
    </div>
</div>
