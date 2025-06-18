@extends('layouts.default')

@section('content')
    @include('includes.breadcrumb', [
        'title' => 'Contact Us',
        'backgroundImage' => 'img/bg-img/hero1.jpg'
    ])

    <section class="south-contact-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-heading">
                        <h6>Contact Info</h6>
                    </div>
                </div>
            </div>

            {{-- Success/Error Messages --}}
            @if(session('success'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="content-sidebar">
                        <!-- Office Hours -->
                        <div class="weekly-office-hours">
                            <h6 class="mb-3">Office Hours</h6>
                            <ul>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span>Monday - Friday</span>
                                    <span>09:00 AM - 07:00 PM</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span>Saturday</span>
                                    <span>09:00 AM - 02:00 PM</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span>Sunday</span>
                                    <span>Closed</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Contact Information -->
                        <div class="address mt-30">
                            <h6 class="mb-3">Get In Touch</h6>
                            <h6><img src="img/icons/phone-call.png" alt="Phone"> {{env('PHONE_NUMBER', '+1 (555) 123-4567')}}</h6>
                            <h6><img src="img/icons/envelope.png" alt="Email"> {{ env('MAIL_FROM_ADDRESS', 'info@example.com') }}</h6>
                            <h6><img src="img/icons/location.png" alt="Address"> {{ env('ADDRESS', '123 Main Street, City, State 12345') }}</h6>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Area -->
                <div class="col-12 col-lg-8">
                    <div class="contact-form">
                        <h6 class="mb-4">Send Us a Message</h6>

                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf

                            <div class="form-group">
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       id="contact-name"
                                       placeholder="Your Full Name"
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone"
                                       id="contact-phone"
                                       placeholder="Your Phone Number"
                                       value="{{ old('phone') }}"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       id="contact-email"
                                       placeholder="Your Email Address"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <textarea class="form-control @error('message') is-invalid @enderror"
                                          name="message"
                                          id="message"
                                          cols="30"
                                          rows="6"
                                          placeholder="Your Message"
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn south-btn" id="submitBtn">
                                <span class="btn-text">Send Message</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fa fa-spinner fa-spin"></i> Sending...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', function() {
        // Disable button and show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });
});
</script>
@endpush
