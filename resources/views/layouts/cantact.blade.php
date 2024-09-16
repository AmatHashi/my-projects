
@extends('layouts.indexFront')

@section('layoutbody')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form id="contactForm" novalidate="novalidate">
                    @csrf
                    <div class="control-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"  />
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"  />
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject"  />
                        @error('subject')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="8" id="message" name="message" placeholder="Message" ></textarea>
                        @error('message')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send Message</button>
                    </div>
                </form>
                
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <!-- Corrected iframe for Google Maps -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3934.3831964575393!2d44.07002947425736!3d9.562197580416461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1628bf406a9cfca3%3A0x2ba820608cbc95d9!2sCurubo%20Mall%20(%20Ex-carwada)!5e0!3m2!1sen!2sso!4v1726398631783!5m2!1sen!2sso" 
                    width="100%" height="250px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Hargiesa</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>amal@gmail.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+252 063 6789076</p>
            </div>
        </div>
        
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

 $(document).ready(function(){
  
  $('#contactForm').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:'store',
        type:'POST',
        data:formData,
        processData: false,
        contentType: false,
        success: function(response) {
                     Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    });
                },
                error: function(xhr) {
                    var errorMsg = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    console.log(errorMsg)
                }

    })

})
  })
</script>