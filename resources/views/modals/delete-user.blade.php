@if(session('deleteUser'))
    <section id="DeleteUserSuccess">
        <div class="deleteUsersModal" id="successUserDeleteModal" style="display:block;">
            <div class="background">
                <div class="deleteItemContainer">
                    <div class="message">
                        <p>User successfully deleted.</p>
                    </div>
                    <div class="formContent">
                        <div class="deleteButtons">
                            <button class="deleteBook" id="okDeleteBtn" onclick="closeSuccessUserDeleteModal()">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Confirmation Modal -->
<section id="DeleteUserConfirmation">
    <div class="deleteUsersModal" id="confirmUserDeleteModal" style="display:none;">
        <div class="background">
            <div class="deleteItemContainer">
                <div class="message">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="formContent">
                    <div class="deleteButtons">
                        <button class="deleteBook" id="deleteUserBtn">Yes</button>

                        <form id="deleteUserForm" action="" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <button class="cancel" id="cancelUserDeleteBtn">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>