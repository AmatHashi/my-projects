

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center ml-5" id="exampleModalLabel">update property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.update')}}" method="POST" enctype="multipart/form-data" id="update">
                    @csrf   
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage()">
                        <div id="imagePreview" class="mt-2"></div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror
                    </div>            
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                     </div>
                     <div class="form-group mb-3">
                        <label for="discription">Description</label>
                        <textarea class="form-control" id="discription" name="discription" rows="3"></textarea>
                        @error('discription')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror
                        </div>
                            <div class="form-group mb-3">
                                <label for="cat_id">Category</label>
                                <select id="cat_id" name="cat_id" class="form-control">
                                    <option value="">Choose category</option>
                                    @foreach ($category as $row) 
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                                @error('price')
                                <div class="invalid-feedback d-block">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark  pl-7" id="submitButton">update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    const updatefn=(id) => {
        let url = "{{ route('product.edit', ':id') }}".replace(':id', id);
        $.get(url)
            .done((data) => {
                $("#name").val(data.name);
                $("#price").val(data.price);
                $("#discription").val(data.discription);
                let updateUrl = "{{ route('products.update', ':id') }}".replace(':id', id);;
                $("#updateModel").attr("action", updateUrl);
                $('#updateModel').modal('toggle');
            })
            .fail((error) => {
                console.error('Error fetching data:', error);
            });
    };
</script>