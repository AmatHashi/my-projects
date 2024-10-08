<form action="{{ route('slideshow.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Slide Title </label>
        <input type="text" name="title" id="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="description">Slide Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="image">Slide Image:</label>
        <input type="file" name="image" id="image" class="form-control" >
    </div>

    <button type="submit" class="btn btn-primary">Add Slide</button>
</form>
