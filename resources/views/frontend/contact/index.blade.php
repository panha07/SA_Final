@extends('frontend.layout.master')
@section('pg_contact', 'active')
@section('content')
    <style>
        .contact-section,
        .contact-section * {
            font-family: "Poppins", Arial, sans-serif !important;
        }
    </style>
    <!-- Contact Section -->
    <section class="contact-section pt-1">

        <div class="container ">
            <hr class="pb-5">
            @include('components.component')
            <div class="row">
                <!-- Contact Info -->
                <div class="col-md-6">
                    <div class="contact-info">
                        <h4 class="mb-5">Contact Information</h4>
                        <a style="color: #506172;"href="https://www.google.com/maps/place/First+Solutions+(Cambodia)+Co.,Ltd/@11.5244198,104.9083168,1134m/data=!3m2!1e3!4b1!4m6!3m5!1s0x310950ffffffffff:0x526bc2dd85b81e52!8m2!3d11.5244198!4d104.9108917!16s%2Fg%2F11hbv8gds4?entry=ttu&g_ep=EgoyMDI1MDEyOS4xIKXMDSoASAFQAw%3D%3D"
                            target="_">
                            <strong>Adress :</strong> #4A1, st. 22BT, Boeung Tumpun, Mean Chey, Phnom Penh, Cambodia</a>
                        <p><strong>Phone:</strong> (855) 12 204 990 / 69 21 1314 </p>
                        <p><strong>Email:</strong> <a style="color: #506172;" href="mailto:limhoung.charles.sturt@gmail.com"
                                target="_"> limhoung.charles.sturt@gmail.com </a></p>
                        <p><strong>Facebook Page :</strong> <a style="color: #506172;"
                                href="https://www.facebook.com/FS211314" target="_"> First Solutions- Cambodia </a> / <a
                                style="color: #506172;" href="https://www.facebook.com/profile.php?id=100063526512569"
                                target="_">First Solutions - Recruitment </a></p>
                        <p><strong>Instagram : </strong><a style="color: #506172;"
                                href="https://www.instagram.com/explore/locations/161474440597822/first-solutions---cambodia/"
                                target="_"> firstsolutionsrecruitment</a></p>

                        <p><a style="color: #506172;" href="https://t.me/fistsolutionshr" target="_"><strong>
                                    First Solutions Jobs Info Telegram Chanel : </strong> First Solutions - Jobs</a> </p>

                        <a style="color: #506172;" href="https://t.me/firstsolutionskh" target="_"><strong>
                                First Solutions Corp. Info Telegram Chanel : </strong> First Solutions - Cambodia</a>


                    </div>
                </div>
                <!-- Contact Form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <h4 class="mb-5">Send Us a Message</h4>
                        <form id="contact-form" method="POST" action="{{ route('frontend.send_telegram_message') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter your email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Telegram Username Field -->
                            <div class="mb-3">
                                <label for="telegram" class="form-label">Telegram Username (Optional)</label>
                                <input type="text" class="form-control @error('telegram') is-invalid @enderror"
                                    id="telegram" name="telegram" placeholder="Enter your Telegram username"
                                    value="{{ old('telegram') }}">
                                @error('telegram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message Field -->
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4"
                                    placeholder="Write your message here...">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                        <div id="response-message" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <script>
        $(document).ready(function() {
            $('#contact-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    telegram: $('#telegram').val(),
                    message: $('#message').val(),
                };

                $.ajax({
                    url: "{{ route('frontend.send_telegram_message') }}",
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#response-message').html(
                                '<div class="alert alert-success">Message sent successfully!</div>'
                                );
                            $('#contact-form')[0].reset(); // Reset the form
                        } else {
                            $('#response-message').html(
                                `<div class="alert alert-danger">${response.error}</div>`);
                        }
                    },
                    error: function(xhr) {
                        $('#response-message').html(
                            '<div class="alert alert-danger">An error occurred while sending the message.</div>'
                            );
                        console.error(xhr.responseText); // Log the error for debugging
                    }
                });
            });
        });
    </script> --}}
@endsection
