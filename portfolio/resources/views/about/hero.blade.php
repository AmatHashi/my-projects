@extends('layouts.sidebar')
@section('sidebarContent')

<div class="container mt-5">
    <h2 class="text-secondary">Edit Hero Profile</h2>
    @foreach ($introduction as $item) 
    <form id="about-form-{{ $item->id }}" action="{{ route('hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <input type="hidden" name="id" value="{{ $item->id }}"> 

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title-{{ $item->id }}" name="title" placeholder="Enter title" value="{{ old('title', $item->title) }}" style="max-width: 800px;height:50px;">
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name-{{ $item->id }}" name="name" placeholder="Enter name" value="{{ old('name', $item->name) }}" style="max-width: 800px;height:50px;">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description-{{ $item->id }}" name="description" rows="4" placeholder="Enter description" style="max-width: 800px;">{{ old('description', $item->description) }}</textarea>
        </div>


       
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    @endforeach
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(this);
            var actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Update failed. Please try again.');
                    console.log(xhr.responseText); // Log the error response for debugging
                }
            });
        });
    });
</script>
@endsection

@endsection
