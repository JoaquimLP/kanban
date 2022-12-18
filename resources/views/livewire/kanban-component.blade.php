<div class="container">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-2 text-center">
        @foreach ($status as $key => $item)
            <div class="col" id="{{$key}}">
                <div class="border bg-light overflow-auto" style="height: 77vh;">
                    <div class="card-header sticky-top  bg-white border-bottom border-{{$item["class"]}} mb-2 p-1">
                        <h6 class="mt-1">{{$item['title']}} ({{$item["atentimentos"]->total()}})</h6>
                    </div>
                    <div class="kanban-category" id="kanban-{{$key}}" style="height: 77vh;">
                        @foreach ($item["atentimentos"] as $atendimento)
                            <div class="card card-kanban mb-0 mb-2 mx-auto text-start card-show" data-id="{{$atendimento->id}}" style="width: 14rem;">
                                <div class="card-body p-3" wire:click.prevent="showAtendimento({{$atendimento->id}})">
                                    <small class="float-end text-muted">{{date_mask1($atendimento->updated_at)}}</small>
                                    <span class="badge bg-{{$item["class"]}}">#{{$atendimento->id}}</span>

                                    <h5 class="mt-2 mb-2">
                                        <span>{{$atendimento->nome}}</span>
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
                                        <img src="{{ asset('img/'.$atendimento->usuario->avatar.'.jpg') }}" alt="user-img" class="avatar-xs rounded-circle me-1">
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
    @include("livewire.include.modal")
</div>

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/sortable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/plugins.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/plugins/swap-animation.js"></script>
    <script>
        $(function (){

            // $( ".card-kanban" ).click(function() {
            //     var id = $(this).data("id");
            //     console.log(id);
            //     @this.showAtendimento(id);
            // });

            var status = null;
            var atendimento = null;

            const sortable = new Sortable.default(document.querySelectorAll('.kanban-category'), {
                draggable: '.card-kanban',
                cancelable: false,
                // mirror: {
                //     constrainDimensions: true,
                //     cursorOffsetX: 10,
                //     cursorOffsetY: 10,
                //     xAxis: false
                // }
            });

            sortable.on('drag:start', function (e) {
                cancelable = true;
            });

            sortable.on('drag:over:container', function (e) {
                status = e.data.overContainer.id
                console.log(e)
                atendimento = e.data.source.getAttribute('data-id')

            });


            sortable.on('drag:stop', function (e) {
                console.log(e)
                //status = e.data.overContainer.id
                @this.updateAtendimento(status, atendimento);
            });

            window.addEventListener('response', event => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                    icon: event.detail.status,
                    title: event.detail.text
                })
            })

            window.addEventListener('open-modal', event => {
                console.log(event.detail);
                $(`#${event.detail.id}`).modal("show")
            })

            window.addEventListener('close-modal', event => {
                console.log(event.detail);
                $(`#${event.detail.id}`).modal("hide")
            })
        })

    </script>
@endpush
