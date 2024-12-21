<section id="editBook">
    <div id="editBookModal" style="display:none;">
        <div class="background">
            <div class="ItemContainer">
                <h3>Edit Book Details</h3>
                <form id="editBookForm" name="editBookForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                   <div class="formContent">
                        <div class="bookInfo">
                            <label for="bookInfo">Book Info</label><br><br>
                            <input type="hidden" id="editBookID" name="editBookID" value="">
                            <div class="labelInput">
                                <label>Cover Image</label>
                                <div class="addImage">
                                    <div class="imageContainer">
                                        <img src="" id="editCoverImage" alt="Cover Image">
                                        <input type="hidden" name="editCoverURL" id="editCoverURL" value=""
                                            required><br><br>
                                    </div>
                                    <div class="addImageBtn">
                                        <label for="input-file" class="addBook">Upload Image</label>
                                        <input type="file" name="editCoverImage"
                                            accept="image/jpeg, image/png, image/jpg" id="editInput-file">
                                    </div>
                                </div>
                            </div>
                            <div class="labelInput">
                                <label>Title</label>
                                <input type="text" id="editTitle" name="title" value="" required><br><br>
                            </div>
                            <div class="labelInput">
                                <label>Author</label>
                                <input type="text" id="editAuthor" name="author" value=""><br><br>
                            </div>
                            <div class="labelInput">
                                <label for="genres">Genre/s</label>
                                <input type="text" id="editGenre" name="genres" value=""><br><br>
                            </div>
                        </div>
                        <div class="additionalInfo">
                            <div class="description">
                                <div class="labelInput">
                                    <label for="descriptionInput">Synopsis</label>
                                    <textarea id="editDesciprion" name="descriptionInput" class="descriptionInput"
                                        rows="4" cols="30" required></textarea><br><br>
                                </div>
                            </div>

                            <div class="modalButtons">
                                <button class="addBook" id="editBookBtn" name="editBookBtn" type="submit">Update
                                    Book</button>
                                <button class="cancel" type="button" id="editCancelBtn"
                                    onclick="closeEditBookModal()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Function to show the edit book modal and pre-fill it with the book data
    function showEditBookModal(bookID) {

        alert('bookid: ' + bookID);

        // Fetch the book data using AJAX or Laravel route, and populate the modal
        fetch(`/books/edit/${bookID}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Dynamically update the form's action with the book ID
                document.getElementById('editBookForm').action = `/books/update/${data.bookID}`;

                document.getElementById('editBookModal').style.display = 'block';
                document.getElementById('editBookID').value = data.bookID;
                document.getElementById('editTitle').value = data.title;
                document.getElementById('editAuthor').value = data.author;
                document.getElementById('editGenre').value = data.genre;
                document.getElementById('editDesciprion').value = data.description;

                let coverPath = data.cover.replace(/\\/g, '/');

                // Update the image preview source
                document.getElementById('editCoverImage').src = coverPath;

                // Update the hidden field value
                document.getElementById('editCoverURL').value = coverPath;

                console.log(coverPath); // Log the corrected path
            })
            .catch(error => console.error('Error fetching book data:', error));
    }

    // Function to close the edit book modal
    function closeEditBookModal() {
        document.getElementById("editBookModal").style.display = "none";
    }

    // Update the book cover image preview when the user selects a new image
    // Get the elements
    let editCoverImage = document.getElementById("editCoverImage"); // The image element you want to change
    let editInputFile = document.getElementById("editInput-file"); // The file input element
    let editCoverURL = document.getElementById("editCoverURL"); // Hidden input to store the file name

    // When the user selects a file
    editInputFile.onchange = function () {
        let editFile = editInputFile.files[0]; // Get the selected file
        if (editFile) {
            // Create a URL for the selected image file
            editCoverImage.src = URL.createObjectURL(editFile); // Update the src of the image
            editCoverURL.value = editFile.name; // Store the file name in the hidden input
            alert(editCoverURL.value); // Optional: log the filename for debugging
        }
    };
</script>