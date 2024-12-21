<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-dash.css') }}">
    <title>Admin</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>

<body>
    <main>
        <section id="booksTable">
            <div class="mainContainer">
                <div class="productDisplay">
                    <div class="delAddProduct">
                        <div class="searchBar">
                            <!-- Update the form to use AJAX -->
                            <form id="searchForm" method="GET">
                                <input type="text" id="search" name="search" placeholder="Search">
                                <button type="submit">Search</button>
                            </form>
                        </div>

                        <button class="removeBook" id="removeBookBtn" onclick="showDeleteBookModal()">Delete
                            Book</button>
                        <button class="addBook" id="addBookBtn" onclick="showAddBookModal()">Add Book</button>
                    </div>

                    <!-- Other content here -->

                    <div class="inventory">
                        <table class="inventoryTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>BookID</th>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Genre</th>
                                    <th>Rating</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Release Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td><input type="checkbox" name="selectedBooks[]"></td>
                                        <td>{{ $book->bookID }}</td>
                                        <td><img src="{{ asset($book->cover) }}" alt="Book Cover"
                                                style="width: 50px; height: auto;"></td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->genre }}</td>
                                        <td>
                                            @if($book->reviews_avg_rating)
                                                {{ number_format($book->reviews_avg_rating, 1) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $book->description }}</td>
                                        <td>{{ $book->created_at }}</td>
                                        <td>{{ $book->updated_at }}</td>
                                        <td>
                                            @if($book->release_date)
                                                {{ $book->release_date }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i> <!-- Ellipsis Icon -->
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="showEditBookModal('{{ $book->bookID }}')">Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <form id="removeBookForm" action="{{ route('books.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" id="selectedBooks" name="selectedBooks">
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- Include the modals from the partial view -->
        @include('modals.add-book')
        @include('modals.edit-book')
        @include('modals.delete-book')
        @include('modals.success-prompt')
        @include('admin.search-results')
    </main>
</body>

<script>
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
</script>

</html>