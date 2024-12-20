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
        <div id="deleteBookModal">
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
                            <button class="cancel" id="deleteCancelBtn">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>