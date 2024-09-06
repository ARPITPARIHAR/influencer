@extends('user.layouts.app')
@section('meta_title', 'game')
@include('user.includes.navbar')

<div class="container-xxl bg-primary page-header">
    <div class="contact-container">
        <h1 class="text-white animated zoomIn mb-3">Contact Us</h1>
        <img src="img/contact-img.png" alt="Contact Image" class="contact-image">
    </div>
</div>
<div class="bubble" style="left: 20%; animation-duration: 8s;"></div>
<div class="bubble" style="left: 40%; animation-duration: 12s;"></div>
<div class="bubble" style="left: 60%; animation-duration: 15s;"></div>
<div class="bubble" style="left: 80%; animation-duration: 18s;"></div>

<div class="container-xxl py-1">
    <div class="container" style="margin-top:30px;">
        <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="d-inline-block border rounded-pill text-primary px-4 mb-3">Contact Us</div>
            <h2 class="mb-5">If You Have Any Query, Please Feel Free Contact Us</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" style="height: 150px" required></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" style="bacakground-color:red;" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style>
.contact-container {
    display: flex;
    justify-content: center; /* Center contents horizontally */
    align-items: center; /* Center contents vertically (optional) */
    position: relative; /* Allow absolute positioning of the image */
    height: 5vh; /* Optional: Adjust height as needed */
    text-align: center; /* Center text inside the container */
}

.contact-image {
    position: absolute;
    right: 0;
    top:10%;
    transform: translateY(-50%);
    /* Optional styles for image size */
    width: 150px; /* Adjust width as needed */
    height: auto; /* Maintain aspect ratio */
}


.bubble {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e4ff83;
            animation: move 10s infinite;
        }

        @keyframes move {
            0% {
                transform: translateY(100vh) scale(1);
            }
            50% {
                transform: translateY(-50vh) scale(1.2);
            }
            100% {
                transform: translateY(100vh) scale(1);
            }
        }
</style>
@include('user.includes.footer')

@section('style')
    <!-- Add your custom CSS here -->
@endsection

@section('script')
    <!-- Add your custom JS here -->
@endsection

