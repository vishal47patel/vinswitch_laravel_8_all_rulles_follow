@extends('layouts.main')

@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>      
    <!-- end page title --> 

    <div class="row">

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
            {{ Auth::user()->first_name}}
            <br>
            {{ $msg}}        
    </div>                     
</div> 


@endsection
