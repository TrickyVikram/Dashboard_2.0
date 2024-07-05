@extends('layouts.app')
@section('content')
    <div>
        <div class="container" style="min-height: 10vh;">

            <div class="d-flex my-5 py-5 align-items-center justify-content-center flex-row" style="font-family: serif;">

                <div class="text-center">

                    @if ($error_code == 404)
                        <div class="fw-bold" style="font-size: 150px;">{{ $error_code }}</div>
                        <p class="text-capitalize fw-normal">The Page You Are Looking For Does Not Exist!</p>
                        <a href="/" class="text-decoration-none text-success fw-bold">
                            <p><i class="fas fa-long-arrow-alt-left"></i>
                                <span class="text-capitalize">&nbsp; back to homepage</span>
                            </p>
                        </a>
                    @elseif ($error_code == 500)
                        <div class="fw-bold" style="font-size: 150px;">{{ $error_code }}</div>
                        <p class="text-capitalize fw-normal">Internal Server Error : An unexpected error occurred on the
                            server.</p>
                        <a href="/" class="text-decoration-none text-success fw-bold">
                            <p><i class="fas fa-long-arrow-alt-left"></i>
                                <span class="text-capitalize">&nbsp; back to homepage</span>
                            </p>
                        </a>
                    @elseif ($error_code == 503)
                        <div class="fw-bold" style="font-size: 150px;">{{ $error_code }}</div>
                        <p class="text-capitalize fw-normal">Service Unavailable : The server is currently unable to handle
                            the request due to temporary overloading or maintenance of the server.</p>
                        <a href="/" class="text-decoration-none text-success fw-bold">
                            <p><i class="fas fa-long-arrow-alt-left"></i>
                                <span class="text-capitalize">&nbsp; back to homepage</span>
                            </p>
                        </a>
                    @elseif ($error_code == 400)
                        <div class="fw-bold" style="font-size: 150px;">{{ $error_code }}</div>
                        <p class="text-capitalize fw-normal">Bad Request : The request cannot be fulfilled due to bad
                            request</p>
                        <a href="/" class="text-decoration-none text-success fw-bold">
                            <p><i class="fas fa-long-arrow-alt-left"></i>
                                <span class="text-capitalize">&nbsp; back to homepage</span>
                            </p>
                        </a>
                    @else
                        <div class="fw-bold" style="font-size: 150px;">{{ $error_code }}</div>
                        <p class="text-capitalize fw-normal">Unspecified Error: Something went wrong, but the specific error
                            is not provided.</p>
                        <a href="/" class="text-decoration-none text-success fw-bold">
                            <p><i class="fas fa-long-arrow-alt-left"></i>
                                <span class="text-capitalize">&nbsp; back to homepage</span>
                            </p>
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
