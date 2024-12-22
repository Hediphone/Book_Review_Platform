<div id="logoutMessage">
    <div class="successPrompt" id="logoutPrompt" style="display:flex;">
        <div class="sucessContainer">
            <div class="image">
                <img class="checksvg" src="/assets/svg/question.png" alt="">
            </div>
            <div class="successMessage">
                <p>Log out successful!</p>
            </div>
            <div class="formContent">
                <div class="successmodalButtons">
                    <button class="addBook" id="add_okBtn" onclick="closeLogoutMessage()">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function closeLogoutMessage() {
        // Redirect to the landing page
        window.location.href = '/'; 
    }
</script>