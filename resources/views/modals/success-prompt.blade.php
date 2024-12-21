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
                        <button class="addBook" id="add_okBtn"
                            onclick="window.location.href='{{ url('/admin-dash') }}'">Ok</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif