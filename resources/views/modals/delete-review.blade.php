<section id="deleteReviews">
    <div id="deleteReviewsModal" class="deleteReviewsModal" style="display:none;">
        <div class="background">
            <div class="deleteItemContainer">
                <div class="image">
                    <img src="/assets/svg/circle-xmark-regular.svg" alt="">
                </div>
                <div class="message">
                    <p>Are you sure you want to delete selected review(s)?</p>
                </div>
                <div class="formContent">
                    <div class="deleteButtons">
                        <button class="deleteBook" id="deleteBtnNew"
                            onclick="removeSelectedReviewsNew()">Confirm</button>
                        <button class="cancel" id="deleteCancelBtnNew"
                            onclick="closeDeleteBookModalNew()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="noneSelectedSection" style="display: none;">
    <div id="noneSelectedMessageNew" class="deleteReviewsModal">
        <div class="background">
            <div class="deleteItemContainer">
                <div class="image">
                    <img src="/assets/svg/circle-xmark-regular.svg" alt="">
                </div>
                <div class="message">
                    <p>Please select at least 1 review to delete.</p>
                </div>
                <div class="formContent">
                    <div class="deleteButtons">
                        <button class="deleteBook" id="okBtnNew" onclick="resetModalsNew()">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

