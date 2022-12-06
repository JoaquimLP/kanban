@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mx-1">
        <div class="col-md-12 bg-secondary bg-opacity-25"  style="min-height: 82vh;">
            <livewire:kanban-component />
        </div>
    </div>
</div>
@endsection
