<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin Dashboard')</title>

    @yield('styles')

    <link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>

<body>
    <section id="sideBar" class="sideBar">
        <div class="features">
            <div class="sbBooks">
                <button id="booksBtn">
                    <img src="/assets/svg/book-white.svg" alt=""><br>
                    <strong>Books</strong>
                </button>
            </div>
            <div class="sbUsers">
                <button id="usersBtn">
                    <img src="/assets/svg/reviews-gray.svg" alt=""><br>
                    <strong>Users</strong>
                </button>
            </div>
            <div class="sbReviews">
                <button id="reviewsBtn">
                    <img src="/assets/svg/user-gray.svg" alt=""><br>
                    <strong>Reviews</strong>
                </button>
            </div>
        </div>
        <div class="logout">
            <div class="sbLogout">
                <a href="" id="logoutBtn">
                    <img src="/assets/svg/logout-gray.svg" alt=""><br>
                </a>
            </div>
        </div>
    </section>

    <main>
        @yield('content')
    </main>

    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        //redirect to Books Dashboard
        document.getElementById("booksBtn").onclick = function () {
            window.location.href = "/admin-books-dashboard";
        };

        //redirect to Users Dashboard
        document.getElementById("usersBtn").onclick = function () {
            window.location.href = "admin/admin-users-dashboard";
        };

        //redirect to Reviews Dashboard
        document.getElementById("reviewsBtn").onclick = function () {
            window.location.href = "admin/admin-reviews-dashboard";
        };

        //redirect to login page
        document.getElementById("logoutBtn").onclick = function () {
            window.location.href = "/admin-books-dashboard";
        };

        // Select all genre buttons
        const genreButtons = document.querySelectorAll('.genreBtn');

        // Add an event listener for each button to toggle the 'active' class
        genreButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Remove the 'active' class from all buttons
                genreButtons.forEach(btn => btn.classList.remove('active'));

                // Add the 'active' class to the clicked button
                this.classList.add('active');
            });
        });

        $(document).ready(function () {
            // Handle the search form submission
            $('#searchForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                var query = $('#search').val(); // Get the search query

                // Send AJAX request
                $.ajax({
                    url: '{{ route('admin.books.search') }}', // The URL for the search route
                    type: 'GET',
                    data: { search: query },
                    success: function (response) {
                        // Update the table with the new search results
                        $('#booksTable tbody').html(response); // Replace the table body
                    },
                    error: function () {
                        alert('There was an error processing your request.');
                    }
                });
            });
        });

        $(document).ready(function () {
            // Handle the genre search form submission
            $('#genreContainer').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                var genre = $('button[name="genre"]:focus').val(); // Get the selected genre

                // Send AJAX request
                $.ajax({
                    url: '{{ route('adminSearchByGenre') }}', // The URL for the genre search route
                    type: 'GET',
                    data: { genre: genre },
                    success: function (response) {
                        // Update the table with the new genre results
                        $('#booksTable tbody').html(response); // Replace the table body with new results
                    },
                    error: function () {
                        alert('There was an error processing your request.');
                    }
                });
            });
        });
    </script>

</body>

</html>