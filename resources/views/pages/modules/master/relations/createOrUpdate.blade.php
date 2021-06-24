@extends('_layouts.base')

@section('title', 'Relation Company')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($relation))

            {{-- Update Relation --}}
            <h2 class="mb-3"> Update Relation </h2>

            {{ Form::model($relation, ['route' => ['relations.update', $relation->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Relation --}}
        @else

            {{-- Create Relation --}}
            <h2 class="mb-3"> Create Relation </h2>

            {{ Form::open(array('route' => 'relations.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            @php
                $relation = null;
            @endphp

            {{-- ./Create Relation --}}
        @endif

        <x-card>

            <x-input name='name' type='text' label='Company Name' :bind='$relation' />
            <x-textarea name='address' type='textarea' label='Address' :bind='$relation' />

            <label for="" class="mb-1">Relation As :</label>
            <div class="row">
                <div class="col-6">
                    <x-checkbox name='is_supplier' label='Supplier' margin='mb-2' :checked='optional($relation)->is_supplier' />
                </div>
                <div class="col-6">
                    <x-checkbox name='is_customer' label='Customer' margin='mb-2' :checked='optional($relation)->is_customer' />
                </div>
            </div>

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        {{ Form::close() }}
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection