<div class="container text-center">
    <div wire:sortable="updateGroupOrder" wire:sortable-group="updateTaskOrder" class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-2">
        @foreach ($status as $key => $item)
            <div class="col" id="{{$key}}">
                <div class="border bg-light overflow-auto" style="height: 77vh;">
                    <div class="card-header sticky-top  bg-white border-bottom border-{{$item["class"]}} mb-2 p-1">
                        <h6 class="mt-1">{{$item['title']}} ({{$item["atentimentos"]->total()}})</h6>
                    </div>
                    <div class="kanban" id="kanban-{{$key}}" wire:key="group-{{ $key }}" wire:sortable.item="{{ $key }}">
                        @foreach ($item["atentimentos"] as $atendimento)
                            <div wire:key="{{$atendimento->id}}" wire:sortable-group.item="{{ $atendimento->id }}"
                                class="card card-kanban mb-0 mb-2 mx-auto text-start" style="width: 14rem;">
                                <div class="card-body p-3">
                                    <small class="float-end text-muted">18 Jul 2022</small>
                                    <span class="badge bg-{{$item["class"]}}">#{{$atendimento->id}}</span>

                                    <h5 class="mt-2 mb-2">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">{{$atendimento->nome}}</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            origem: <strong>{{$atendimento->origem}}</strong>
                                        </span>
                                        <br>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                            {{mask_phone($atendimento->celular)}}
                                        </span>
                                    </p>

                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical font-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                        </div>
                                    </div>

                                    <p class="mb-0">
                                        <img src="{{ asset('img/team-'.rand(1, 4).'.jpg') }}" alt="user-img" class="avatar-xs rounded-circle me-1">
                                        <span class="align-middle">{{limit($atendimento->usuario->name, 10)}}</span>
                                    </p>
                                </div> <!-- end card-body -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    <script>
        // $(function () {
        //     //import Draggable from '@shopify/draggable/lib/draggable';
        //     const draggable = new Draggable.default(document.querySelectorAll('.kanban'), {
        //         group: '.card-kanban'
        //     });

        //     draggable.on('drag:start', () => {
        //         // make it half transparent
        //         event.target.classList.add("dragging");
        //         console.log(event.target.id);
        //             //e.target.classList.add("dragging");
        //     });

        //     draggable.on('drag:move', () => {
        //         // make it half transparent
        //         console.log(event.target);
        //     });

        //     draggable.on('drag:stop', () => {
        //         console.log(event.target);
        //         event.target.classList.remove("dragging");
        //     });


        // });
        //



    </script>
@endpush
