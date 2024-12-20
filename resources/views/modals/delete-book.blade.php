@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/modals/modalMessage.css') }}">
@endsection

@section('content')
<x-navbar />

<section id="modalMessage">
    <div class="modalConfirmBackground" id="modalConfirmBackground">
        <div class="modalConfirmItemContainer">
            <div class="image">
                <img src="../assets/confirmation.svg" alt="">
            </div>
            <div class="message">
                <p>Are you sure you want to delete selected product(s)?</p>
            </div>
            <div class="formContent">
                <div class="modalButtons">
                    <button class="addProduct" id="confirmBtn">Confirm</button>
                    <button class="cancel" id="confirmCancelBtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection