@extends('Components.Admin-Dashboard-Layout')

@section('title', 'Admin Reviews Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/admin-reviews-dashboard.css') }}">
@endsection

@section('content')

<section id="reviewsTable">
    <div class="mainContainer">
        <div class="productDisplay">
            <div class="delAddProduct">
                <div class="searchBar">
                    <form id="searchForm" method="GET">
                        <input type="text" id="search" name="search" placeholder="Search">
                        <button type="submit" class="searchBtn">Search</button>
                        <button type="button" class="clearBtn">Clear</button>
                    </form>
                </div>

                <button class="removeReview" id="removeReviewBtn" onclick="showDeleteReviewModalNew()">Delete
                    Review</button>
                <button class="addReview" id="addReviewBtn">Add Review</button>
            </div>

            <!-- Rating Buttons Form -->
            <form class="rating" id="ratingContainer" name="form" action="{{ route('admin.reviews.search') }}"
                method="GET">
                <button class="ratingBtn" type="submit" name="rating" value="All">All</button>
                <button class="ratingBtn" type="submit" name="rating" value="1">1 Star</button>
                <button class="ratingBtn" type="submit" name="rating" value="2">2 Stars</button>
                <button class="ratingBtn" type="submit" name="rating" value="3">3 Stars</button>
                <button class="ratingBtn" type="submit" name="rating" value="4">4 Stars</button>
                <button class="ratingBtn" type="submit" name="rating" value="5">5 Stars</button>
            </form>

            <div class="inventory">
                <table class="inventoryTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Book Title</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                        </tr>
                    </thead>
                    <tbody id="reviewsTableBody">
                        @foreach ($reviews as $review)
                            <tr>
                                <td><input type="checkbox" name="selectedReviews[]" value="{{ $review->reviewID }}"></td>
                                <td>{{ $review->reviewID }}</td>
                                <td>{{ $review->book->title }}</td>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ number_format($review->rating, 1) }}</td>
                                <td>{!! $review->highlighted_comment !!}</td> <!-- Display highlighted comment -->
                                <td>{{ $review->created_at }}</td>
                                <td>{{ $review->updated_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i> <!-- Ellipsis Icon -->
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Include the delete modal -->
@include('modals.delete-review')

<!-- Hidden input field for selected reviews -->
<form id="removeReviewForm" method="POST" action="{{ route('admin.reviews.delete') }}">
    @csrf
    <input type="hidden" id="selectedReviews" name="selectedReviews">
</form>

<script>
    $(document).ready(function () {
        // Search functionality (already working)
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();
            var query = $('#search').val();

            $.ajax({
                url: '{{ route('admin.reviews.search') }}',
                type: 'GET',
                data: { search: query },
                success: function (response) {
                    $('#reviewsTableBody').html(response);
                },
                error: function () {
                    alert('There was an error processing your request.');
                }
            });
        });

        $(document).ready(function () {
            // Handle search and rating form submission
            $('#ratingContainer').on('submit', function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Get the selected rating
                var rating = $('button[name="rating"]:focus').val();  // Use the focused button value or the one clicked

                // Get the search query from the search input 
                var query = $('#search').val();

                // Send the AJAX request
                $.ajax({
                    url: '{{ route('admin.reviews.search') }}',
                    type: 'GET',
                    data: { search: query, rating: rating },
                    success: function (response) {
                        $('#reviewsTableBody').html(response);  // Update the table with the filtered results
                    },
                    error: function () {
                        alert('There was an error processing your request.');
                    }
                });
            });

            // Add active class or styling for the selected rating button
            $('.ratingBtn').on('click', function () {
                // Remove active class from all buttons
                $('.ratingBtn').removeClass('active');

                // Add active class to the clicked button
                $(this).addClass('active');
            });
        });
    });

    // When the "Clear" button is clicked, refresh the page
    $('.clearBtn').on('click', function () {
        // Reload the page
        location.reload();
    });

    // Open the delete modal
    function showDeleteReviewModalNew() {
        const selectedReviewsNew = [];
        const reviewCheckboxesNew = document.querySelectorAll('input[name="selectedReviews[]"]:checked');

        reviewCheckboxesNew.forEach((reviewCheckbox) => {
            const row = reviewCheckbox.closest('tr');
            const reviewIDNew = row.querySelector('td:nth-child(2)').textContent.trim(); // Adjust index if needed
            selectedReviewsNew.push(reviewIDNew);
        });

        if (selectedReviewsNew.length === 0) {
            // Show "none selected" modal
            document.getElementById('noneSelectedSection').style.display = 'block';
            document.getElementById('deleteReviewsModal').style.display = 'none';
            return;
        }

        // Show the delete modal
        document.getElementById('deleteReviewsModal').style.display = 'block';
        document.getElementById('noneSelectedSection').style.display = 'none';
    }

    function removeSelectedReviewsNew() {
        const selectedReviewsNew = [];
        const reviewCheckboxesNew = document.querySelectorAll('input[name="selectedReviews[]"]:checked');

        reviewCheckboxesNew.forEach((reviewCheckbox) => {
            const row = reviewCheckbox.closest('tr');
            const reviewIDNew = row.querySelector('td:nth-child(2)').textContent.trim(); // Adjust index if needed
            selectedReviewsNew.push(reviewIDNew);
        });

        if (selectedReviewsNew.length === 0) {
            // Show noneSelected modal and hide deleteReviewModal
            document.getElementById('deleteReviewsModal').style.display = 'none';
            document.getElementById('noneSelectedSection').style.display = 'block';
            return; // Exit the function to prevent further execution
        }

        // Assign the collected IDs to the hidden field
        document.getElementById('selectedReviews').value = selectedReviewsNew.join(',');

        // Submit the form
        document.getElementById('removeReviewForm').submit();
    }

    function resetModalsNew() {
        // Reset the modals to their original state
        document.getElementById('noneSelectedSection').style.display = 'none';
    }

    // Close the delete modal
    function closeDeleteBookModalNew() {
        document.getElementById('deleteReviewsModal').style.display = 'none';
    }
</script>

@endsection