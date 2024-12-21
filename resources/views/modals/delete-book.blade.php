<section id="deleteBook">
    <div id="deleteBookModal" class="deleteBookModal">
        <div class="background">
            <div class="deleteItemContainer">
                <div class="image">
                    <img src="/assets/svg/circle-xmark-regular.svg" alt="">
                </div>
                <div class="message">
                    <p>Are you sure you want to delete selected book(s)?</p>
                </div>
                <div class="formContent">
                    <div class="deleteButtons">
                        <button class="deleteBook" id="deleteBtn" onclick="removeSelectedProducts()">Confirm</button>
                        <button class="cancel" id="deleteCancelBtn" onclick="closeDeleteBookModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Open the delete modal
    function showDeleteBookModal() {
        document.getElementById('deleteBookModal').style.display = 'flex';
    }

    // Close the delete modal
    function closeDeleteBookModal() {
        document.getElementById('deleteBookModal').style.display = 'none';
    }

    function removeSelectedProducts() {
        const selectedBooks = [];
        const checkboxes = document.querySelectorAll('input[name="selectedBooks[]"]:checked');

        checkboxes.forEach((checkbox) => {
            const row = checkbox.closest('tr');
            const bookID = row.querySelector('td:nth-child(2)').textContent.trim();
            selectedBooks.push(bookID);
        });

        // Assign the collected IDs to the hidden field
        document.getElementById('selectedBooks').value = selectedBooks.join(',');

        // Submit the form
        document.getElementById('removeBookForm').submit();
    }
</script>