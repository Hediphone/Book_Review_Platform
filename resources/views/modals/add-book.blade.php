<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
    <title>Add New Book</title>
</head>

<body>

    <section id="addNewBook">
        <div id="addBookModal" style="display:none;">
            <div class="background">
                <div class="ItemContainer">
                    <h3>Add New Book</h3>
                    <form id="addBookForm" name="addBookForm" action="{{ route('books.add') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="formContent">
                            <div class="bookInfo">
                                <label for="bookInfo">Book Info</label><br><br>
                                <div class="labelInput">
                                    <label>Cover Image</label>
                                    <div class="addImage">
                                        <div class="imageContainer">
                                            <img src="/assets/svg/addImage.svg" id="coverImage">
                                            <input type="hidden" name="coverURL" id="coverURL" required><br><br>
                                        </div>
                                        <div class="addImageBtn">
                                            <label for="input-file" class="addBook">Upload Image</label>
                                            <input type="file" name="coverImage"
                                                accept="image/jpeg, image/png, image/jpg," id="input-file">
                                        </div>
                                    </div>
                                </div>
                                <div class="labelInput">
                                    <label>Title</label>
                                    <input type="text" name="title" required><br><br>
                                </div>
                                <div class="labelInput">
                                    <label>Author</label>
                                    <input type="text" name="author"><br><br>
                                </div>
                                <div class="labelInput">
                                    <label for="genres">Genre/s</label>
                                    <input type="text" name="genres"><br><br>
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
                                    <button class="addBook" id="addNewBookBtn" name="addNewBookBtn" type="submit">Add
                                        Book</button>
                                    <button class="cancel" type="button" id="addCancelBtn"
                                        onclick="closeModal()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
    <section id="addSuccess">
        <div class="successPrompt" id="add_successPrompt" style="display:flex;">
            <div class="sucessContainer">
                <div class="image">
                    <img class="checksvg" src="/assets/svg/check.png" alt="">
                </div>
                <div class="successMessage">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="formContent">
                    <div class="successmodalButtons">
                        <button class="addBook" id="add_okBtn"
                            onclick="window.location.href='{{ url('/admin-dash') }}'">Ok</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</body>

<script>
    // Get the elements
    let coverImage = document.getElementById("coverImage"); // The image element you want to change
    let inputFile = document.getElementById("input-file"); // The file input element
    let coverURL = document.getElementById("coverURL"); // Hidden input to store the file name

    // When the user selects a file
    inputFile.onchange = function () {
        let file = inputFile.files[0]; // Get the selected file
        if (file) {
            // Create a URL for the selected image file
            coverImage.src = URL.createObjectURL(file); // Update the src of the image
            coverURL.value = file.name; // Store the file name in the hidden input
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.successPrompt')) {
            // Hide the addBookModal if successPrompt is displayed
            const addBookModal = document.getElementById('addBookModal');
            if (addBookModal) {
                addBookModal.style.display = 'none';
            }
        }
    });

    function closeModal() {
        // Close the modal or reset the form
        document.getElementById("addBookModal").style.display = "none";
    }
</script>

</html>