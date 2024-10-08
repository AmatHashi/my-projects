@extends('layouts.app')
@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Contact Messages</h2>
            @if($contact->isEmpty())
                <div class="alert alert-info" role="alert">
                    No messages found.
                </div>
            @else
                <div class="row">
                    @foreach($contact as $message)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $message->subject }}</h5>
                                    <p class="card-text">{{ $message->message }}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">From: {{ $message->email }} | Sent at: {{ $message->created_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
