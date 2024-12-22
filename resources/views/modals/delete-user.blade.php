@if(session('deleteUser'))
    <section id="DeleteUserSuccess">
        <div class="successPrompt" id="successUserDeleteModal" style="display:flex;">
            <div class="sucessContainer">
                <div class="successMessage">
                    <p>{{ session('message') }}</p>
                </div>
                <div class="formContent">
                    <div class="successmodalButtons">
                        <button class="addBook" id="add_okBtn" onclick="closeSuccessUserDeleteModal()">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Confirmation Modal -->
<section id="DeleteUserConfirmation">
    <div class="successPrompt" id="confirmUserDeleteModal" style="display:none;">
        <div class="sucessContainer">
            <div class="successMessage">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="formContent">
                <div class="successmodalButtons">
                    <button class="addBook" id="deleteUserBtn">Yes</button>
                    <button class="addBook" id="cancelUserDeleteBtn">No</button>
                </div>
            </div>
        </div>
    </div>
</section>
