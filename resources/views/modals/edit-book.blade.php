<section id="editBookInfo">
    <div id="editBookModal">
        <div class="background">
            <div class="ItemContainer">
                <h3>Edit Book Information</h3>
                <form id="editBookForm" name="editBookForm" action="{{ route('books.updateBook') }} method=" POST">
                    @csrf
                    <div class="formContent">
                        <div class="bookInfo">
                            <label for="bookInfo">Book Info</label><br><br>
                            <div class="labelInput">
                                <label>Cover Image</label>
                                <div class="addImage">
                                    <div class="imageContainer">
                                        <img src="" id="editCoverImage" alt="Cover Image">
                                        <input type="hidden" id="coverURLInput" name="coverURLInput">
                                    </div>
                                    <div class="addImageBtn">
                                        <label for="editInput-file" class="editBook">Upload Image</label>
                                        <input type="file" accept="image/jpeg, image/png, image/jpg" id="editInput-file"
                                            name="coverImage">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="bookIdInput" name="bookIdInput">

                            <div class="labelInput">
                                <label>Title</label>
                                <input type="text" id="titleInput" name="titleInput" required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Author</label>
                                <input type="text" id="authorInput" name="authorInput"><br><br>
                            </div>

                            <div class="labelInput">
                                <label for="genre">Genre/s</label>
                                <input type="text" name="genresInput" id="genresInput"><br><br>
                            </div>
                        </div>

                        <div class="additionalInfo">
                            <div class="description">
                                <div class="labelInput">
                                    <label for="descriptionInput">Synopsis</label>
                                    <textarea id="descriptionInput" name="descriptionInput" class="descriptionInput"
                                        rows="4" cols="30" required></textarea><br><br>
                                </div>
                            </div>

                            <div class="modalButtons">
                                <button class="editBook" id="editBookBtn" name="editBookBtn" type="submit">Save
                                    Book</button>
                                <button class="cancel" id="editCancelBtn" onclick="closeEditModal()">Cancel</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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