@extends('layouts.indexFront')

@section('layoutbody')
<div class="container py-5">
    <!-- First Row -->
    <div class="row mb-4">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/img/aaa.webp') }}" class="img-fixed rounded shadow-sm" alt="Image 1">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center text-center">
            <div class="text-content">
                <h1 class="mb-3">Who We Are</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse fugiat delectus impedit ipsam in provident. Repudiandae perferendis, eius veritatis impedit numquam quasi consectetur magni dolore sunt quae. Laudantium, possimus at?</p>
                <a href="{{route('contact')}}" class="btn btn-primary rounded font-bold">Contact</a>
            </div>
        </div>
    </div>
    
    <hr class="my-5">

    <!-- Second Row -->
    <div class="row">
        <div class="col-md-6 d-flex flex-column justify-content-center text-center">
            <div class="text-content">
                <h1 class="mb-3">Why Choose Us</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla totam quibusdam corrupti tenetur qui beatae doloremque eaque eos, autem nihil? Nam, nisi non aliquid repudiandae accusantium ducimus voluptates consequuntur vitae!</p>
                <a href="{{route('collection')}}" class="btn btn-primary rounded">Shop</a>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/img/image3.jpg') }}" class="img-fixed rounded shadow-sm" alt="Image 2">
        </div>
    </div>
</div>
@endsection

<style>
    .img-fixed {
        width: 100%;  
        height: 260px; 
        object-fit: cover;
    }
    
    .text-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        text-align: justify;
    }
    
    .btn {
        margin-top: 15px;
    }
</style>
