@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="asset/css/contact.css">
@endsection

@section('content')

<x-navbar />

    <main>
        <h1>CONTACT US</h1>
        <div class="container">
            <div class="contact-box">
                <p>We'd Love To Hear From You! <br> Let's Get in Touch</p>
            
                <div class="form-fields">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Full Name</label>
                            <textarea name="fullname" placeholder="Enter name" rows="1"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Company</label>
                            <textarea name="company" placeholder="Company name" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Email</label>
                            <textarea name="email" placeholder="example@gmail.com" rows="1"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Phone Number</label>
                            <textarea name="phone" placeholder="+1 (555) 000 - 0000" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" placeholder="Brgy, City, Province" rows="1"></textarea>
                    </div>
                    <div class="message-form mb-3">
                        <label>Your Message</label>
                        <textarea name="message" placeholder="Type your message here" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </div>
            <img src="asset/images/front.png" alt="Illustration" class="contact-image">
        </div>
    </main>
@endsection
