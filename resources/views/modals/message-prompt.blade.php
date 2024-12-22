@if(session('violation'))
    <section id="Success">
        <div class="successPrompt" id="successPrompt" style="display:flex;">
            <div class="sucessContainer">
                
                <div class="successMessage">
                    <p>{{ session('violation') }}</p>
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

@if(session('message'))
    <section id="Success">
        <div class="successPrompt" id="successPrompt" style="display:flex;">
            <div class="sucessContainer">
                
                <div class="successMessage">
                    <p>{{ session('message') }}</p>
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

@if(session('deleteUser'))
    <section id="Success">
        <div class="successPrompt" id="successPrompt" style="display:flex;">
            <div class="sucessContainer">
                <div class="successMessage">
                    <p>{{ session('message') }}</p>
                </div>
                <div class="formContent">
                    <div class="successmodalButtons">
                        <button class="addBook" id="add_okBtn" onclick="closeSuccessModal()">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
