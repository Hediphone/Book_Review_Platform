<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
    <title>Delete Book</title>
</head>

<body>
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
                            <button class="deleteBook" id="deleteBtn">Confirm</button>
                            <button class="cancel" id="deleteCancelBtn" onclick="closeDeleteBookModal()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    function showDeleteBookModal() {
        document.getElementById('deleteBookModal').style.display = 'block';
    }
    
    function closeDeleteBookModal() {
        // Close the modal or reset the form
        document.getElementById("deleteBookModal").style.display = "none";
    }

    //get the selected checkboxes
    function getSelectedCheckboxes() {
        var checkboxes = document.querySelectorAll('.inventoryTable tbody input[type="checkbox"]:checked');
        var selectedBooks = [];
        checkboxes.forEach(function (checkbox) {
            selectedBooks.push(checkbox.value);
        });
        return selectedBooks;
    }

    //removal of selected products
    function removeSelectedProducts() {
        var selectedBooks = getSelectedCheckboxes();

        var modalConfirm = document.getElementById("deleteBookModal");
        modalConfirm.style.display = "flex";


        var confirmCancelBtn = document.getElementById("confirmCancelBtn");

        confirmCancelBtn.addEventListener("click", function () {
            var modalConfirm = document.getElementById("deleteBookModal");

            modalConfirm.style.display = "none";
        });


        var confirmation = document.getElementById("confirmBtn");

        confirmation.addEventListener("click", function () {
            //update the hidden input field with selected products 
            document.getElementById("selectedBooks").value = selectedBooks.join(',');

            document.getElementById("removeBookForm").submit();

            var remove_successPrompt = document.getElementById("remove_successPrompt");

            remove_successPrompt.style.display = "flex";

            var remove_okBtn = document.getElementById("remove_okBtn");

            remove_okBtn.addEventListener("click", function () {
                remove_successPrompt.style.display = "none";
            });
        });
    }

    document.getElementById("removeBookBtn").onclick = function () {
        removeSelectedProducts();
    };
</script>

</html>