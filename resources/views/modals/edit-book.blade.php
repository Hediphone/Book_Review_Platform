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