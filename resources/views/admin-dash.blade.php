<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-dash.css') }}">
    <title>Admin</title>
</head>

<body>
    <main>
    
        <section id="booksTable">
            <div class="mainContainer">
                <div class="productDisplay">
                    <div class="delAddProduct">
                        <div class="searchBar">
                            <input type="text" id="search" placeholder="Search">
                        </div>
                        <button class="inventoryLogBtn" id="inventory_LogBtn">Inventory Log </button>
                        <button class="removeBook" id="removeBookBtn">Delete Book</button>
                        <button class="addBook" id="addBookBtn"  onclick="showAddBookModal()">Add Book</button>
                    </div>
                    <form class="genre" id="genreContainer" name="form" action="" method="post">
                        <button class="genreBtn" type="submit" name="genre" value="All">All</button>
                        <button class="genreBtn" type="submit" name="genre" value="Action">Action</button>
                        <button class="genreBtn" type="submit" name="genre" value="Fantasy">Fantasy</button>
                        <button class="genreBtn" type="submit" name="genre" value="Romance">Romance</button>
                        <button class="genreBtn" type="submit" name="genre" value="Adventure">Adventure</button>
                        <button class="genreBtn" type="submit" name="genre" value="Fiction">Fiction</button>
                        <button class="genreBtn" type="submit" name="genre"
                            value="Science-Fiction">Science-Fiction</button>
                        <button class="genreBtn" type="submit" name="genre" value="Mystery">Mystery</button>
                        <button class="genreBtn" type="submit" name="genre" value="Thriller">Thriller</button>
                        <button class="genreBtn" type="submit" name="genre" value="Literary Fiction">Literary
                            Fiction</button>
                        <button class="genreBtn" type="submit" name="genre" value="Historical Fiction">Historical
                            Fiction</button>
                        <button class="genreBtn" type="submit" name="genre" value="Contemporary">Contemporary</button>
                        <button class="genreBtn" type="submit" name="genre" value="Crime Fiction">Crime Fiction</button>
                        <button class="genreBtn" type="submit" name="genre" value="Drama">Drama</button>
                        <button class="genreBtn" type="submit" name="genre" value="Psychology">Psychology</button>
                        <button class="genreBtn" type="submit" name="genre" value="Travel">Travel</button>
                        <button class="genreBtn" type="submit" name="genre" value="True Crime">True Crime</button>
                    </form>
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
                                            <!-- Ellipsis icon to trigger dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-link dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i> <!-- Ellipsis Icon -->
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <!-- Edit and Delete actions -->
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="editBook('{{ $book->bookID }}', '{{ $book->genre }}')">Edit</a>

                                                        <!-- <li><a class="dropdown-item" href="#"
                                                                            onclick="deleteBook({{ $book->bookID }})">Delete</a></li> -->
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <form id="removeBookForm" name="form" action="" method="post">
                            <input type="hidden" id="selectedBooks" name="selectedBooks">
                        </form>
                    </div>
                </div>
            </div>
        </section>

   

    <!-- Include the modals from the partial view -->
    @include('modals.add-book')
    @include('modals.edit-book')
    </main>
</body>
<script>
    function showAddBookModal() {
        document.getElementById('addBookModal').style.display = 'block';
    }
</script>

<script>
    // JavaScript for handling edit and delete
    function editBook(bookId, genre) {
        alert('Edit book with ID: ' + bookId);
        // Show the modal
        document.getElementById('editBookModal').style.display = 'block';
        // Populate the modal with book information
        populateModal(bookId, genre);
    }

    function closeEditModal() {
        document.getElementById('editBookModal').style.display = 'none';
    }

    function deleteBook(bookId) {
        if (confirm('Are you sure you want to delete this book?')) {
            alert('Delete book with ID: ' + bookId);
            // You can replace this alert with your actual delete logic, e.g., using AJAX to delete the book
        }
    }

    function populateModal(bookId, genre) {
        // Fetch book information from the server
        fetch(`/books/${genre}/${bookId}/json`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch book details');
                }
                return response.json(); // Parse response as JSON
            })
            .then(data => {
                // Populate modal fields with fetched data
                document.getElementById('titleInput').value = data.title || '';
                document.getElementById('authorInput').value = data.author || '';
                document.querySelector('input[name="genresInput"]').value = data.genre || '';
                document.getElementById('descriptionInput').value = data.synopsis || '';
                document.getElementById('editCoverImage').src = data.coverImage || '/assets/svg/addImage.svg';
            })
            .catch(error => {
                console.error('Error fetching book details:', error);
                alert('Unable to fetch book details. Please try again later.');
            });
    }


</script>


</html>