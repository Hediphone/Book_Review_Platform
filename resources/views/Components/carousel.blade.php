    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('asset/css/layout.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=McLaren&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <section class="carousel-section" style="margin-top: 10px;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="center-image" src="{{ asset('assets/images/slide1.png') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="center-image" src="{{ asset('assets/images/slide2.png') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="center-image" src="{{ asset('assets/images/slide3.png') }}" alt="Third slide">
                    </div>
                </div>

                <!-- Carousel Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleControls" data-slide-to="1"></li>
                    <li data-target="#carouselExampleControls" data-slide-to="2"></li>
                </ol>
            </div>
    </section>
