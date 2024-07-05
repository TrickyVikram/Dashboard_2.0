

@extends('layouts.app')
@section('content')
<div>
    <div class="container" style="min-height: 60vh;">

        <div class="d-flex my-5 py-5 align-items-center justify-content-center flex-row" style="font-family: serif;">
            <div class="text-center">
                <div class="fw-bold" style="font-size: 150px;">404</div>
            
            <p class="text-capitalize fw-normal">The Page You Are Looking For Does Not Exists!</p>
            <a href="/" class="text-decoration-none text-success fw-bold">
                <p><i class="fas fa-long-arrow-alt-left"></i> 
                    <span class="text-capitalize">&nbsp; back to homepage
                    </span>
                </p>
            </a>
            </div>
        </div>
    </div>
</div>
@endsection