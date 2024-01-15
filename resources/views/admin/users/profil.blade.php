@extends('layouts.app')
@section('title', 'Profil')

@push('css')
    <style>
        .title{
            color:grey;
        }

        .rectangle {
            height: 20px;
            width: 45px;
            background-color: #2D3748;
        }
    </style>
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div id="title">
                {{-- <span class='d-block mb-3 text-dark font-weight-bold'>Profile  {{ $title }}</span> --}}
                <b><h3>Profile </h3></b>
                <h5>Detail data profile dan perbarui informasi</h5>
            </div>
            <x-card style="margin-top: 3%; box-shadow: 0px 0px 0px #888, 0px -5px 0px #611857">
                <x-slot name="header" class="bg-white border-bottom-0">
                    <ul class="nav nav-pills" id="myTab" role="tablist" style="margin-left: 2%;">
                        <li class="nav-item nav-profile d-none d-lg-flex" role="presentation">
                            {{-- <img src="{{ asset('images/profile/profile.png') }}" alt="profile" style="width: 100%; border-radius: 50%;"/> --}}
                            <img src="https://ui-avatars.com/api/?name={{auth()->user()->name}}background=0D8ABC&color=ff" alt="profile" style="width: 120px; min-height: 120px; max-height: auto; border-radius: 50%;"/>
                        </li>
                        <div style="margin-top: 4%;">
                            <h3>{{ auth()->user()->name }}</h3>
                        </div>
                    </ul>
                </x-slot>
            </x-card>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript"></script>
@endpush
