@if(session('success'))
    <section id="Success">
        <div class="successPrompt" id="successPrompt" style="display:flex;">
            <div class="sucessContainer">
                <div class="image">
                    <img class="checksvg" src="/assets/svg/check.png" alt="">
                </div>
                <div class="successMessage">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="formContent">
                    <div class="successmodalButtons">
                        <button class="addBook" id="add_okBtn" onclick="closeSuccessModal()">Ok</button>
                    </div>

                    <script>
                        function closeSuccessModal() {
                            // Find the modal container and hide it
                            document.getElementById('successPrompt').style.display = 'none';
                        }
                    </script>

                </div>
            </div>
        </div>
    </section>
@endif