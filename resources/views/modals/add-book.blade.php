@extends('Components.Layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/modals/modals.css') }}">
@endsection

@section('content')
<x-navbar />

<section id="addNewBook">
    <div id="addBookModal">
        <div class="background">
            <div class="ItemContainer">
                <h3>Add New Book</h3>
                <form id="addBookForm" name="addBookForm" action="" method="POST">
                    <div class="formContent">
                        <div class="bookInfo">
                            <label for="bookInfo">Book Info</label><br><br>
                            <div class="labelInput">
                                <label>Cover Image</label>
                                <div class="addImage">
                                    <div class="imageContainer">
                                        <img src="/assets/svg/addImage.svg" id="coverImage">
                                        <input type="hidden" name="coverURL" id="coverUR:" required><br><br>
                                    </div>
                                    <div class="addImageBtn">
                                        <label for="input-file" class="addBook">Upload Image</label>
                                        <input type="file" accept="image/jpeg, image/png, image/jpg," id="input-file">
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
                                    <label>Synopsis</label>
                                    <input type="text" name="description" required><br><br>
                                </div>
                            </div>
                         
                            <div class="modalButtons">
                                <button class="addBook" id="addNewBookBtn" name="addNewBookBtn"
                                    type="submit">Add Book</button>
                                <button class="cancel" id="cancelBtn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection