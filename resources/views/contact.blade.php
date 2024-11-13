<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<main>
        <h1>CONTACT US</h1>
        <p>We'd Love To Hear From You! <br> Let's Get in Touch</p>
        

        <p><i class="fas fa-envelope icon"></i> Full Name</p>
            <form action="#" method="post">
                <textarea name="message" placeholder="Enter name" rows="2"></textarea>
            </form>

            <p><i class="fas fa-envelope icon"></i> Company</p>
            <form action="#" method="post">
                <textarea name="message" placeholder="Company name" rows="2"></textarea>
            </form>

            <p><i class="fas fa-envelope icon"></i> Email</p>
            <form action="#" method="post">
                <textarea name="message" placeholder="example@gmail.com" rows="2"></textarea>
            </form>

            <p><i class="fas fa-envelope icon"></i> Phone number</p>
            <form action="#" method="post">
                <textarea name="message" placeholder="+1 (555) 000 - 0000" rows="2"></textarea>
            </form>

            <p><i class="fas fa-envelope icon"></i> Address</p>
            <form action="#" method="post">
                <textarea name="message" placeholder="Brgy, City, Province" rows="2"></textarea>
            </form>


        <section class="message-form">
            <h2><i class="fas fa-envelope icon"></i> Send us a message</h2>
            <form action="#" method="post">
                <textarea name="message" placeholder="Type your message here" rows="5"></textarea>
                <button type="button" onclick="window.location.href='{{ url('/contact') }}'">Submit</button>
            </form>
        </section>

    </main>


</body>

</html>