<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
    <title>Edit Book Information</title>
</head>

<body>
    <section id="editBookInfo">
        <div id="editBookModal">
            <div class="background">
                <div class="ItemContainer">
                    <h3>Edit Book Information</h3>
                    <form id="editBookForm" name="editBookForm" action="" method="POST">
                        <div class="formContent">
                            <div class="bookInfo">
                                <label for="bookInfo">Book Info</label><br><br>
                                <!-- <div class="labelInput">
                                    <label>Cover Image</label>
                                    <div class="addImage">
                                        <div class="imageContainer">
                                            <img src="../assets/addImage.svg" id="editCoverImage">
                                            <input type="hidden" id="coverURLInput" name="coverURLInput"><br><br>
                                        </div>
                                        <div class="addImageBtn">
                                            <label for="editInput-file" class="editBook">Upload Image</label>
                                            <input type="file" accept="image/jpeg, image/png, image/jpg,"
                                                id="editInput-file">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="labelInput">
                                    <label>Cover Image</label>
                                    <div class="addImage">
                                        <div class="imageContainer">
                                            <!-- Display uploaded image if it exists -->
                                            @if(isset($book) && $book->coverImage)
                                                <img src="{{ asset('storage/' . $book->coverImage) }}" id="editCoverImage"
                                                    alt="Cover Image">
                                            @else
                                                <img src="../assets/addImage.svg" id="editCoverImage" alt="Cover Image">
                                            @endif
                                            <input type="hidden" id="coverURLInput" name="coverURLInput"
                                                value="{{ $book->coverImage ?? '' }}"><br><br>
                                        </div>
                                        <div class="addImageBtn">
                                            <label for="editInput-file" class="editBook">Upload Image</label>
                                            <input type="file" accept="image/jpeg, image/png, image/jpg"
                                                id="editInput-file" name="coverImage">
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" id="bookIdInput" name="productIdInput">

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
                                    <input type="text" name="genresInput"><br><br>
                                </div>
                            </div>

                            <div class="additionalInfo">
                                <div class="description">
                                    <div class="labelInput">
                                        <label>Synopsis</label>
                                        <input type="text" id="descriptionInput" name="descriptionInput"
                                            id="descriptionInput" required><br><br>
                                    </div>
                                </div>
                                <input type="hidden" name="updateBooleanInput" id="updateBooleanInput">


                                <div class="modalButtons">
                                    <button class="editBook" id="editBookBtn" name="editBookBtn" type="submit">Save
                                        Book</button>
                                    <button class="cancel" id="editCancelBtn">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>