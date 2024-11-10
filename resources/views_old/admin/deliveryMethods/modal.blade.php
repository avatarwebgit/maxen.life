<!-- add/edit form modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title">
                    توضیحات
                </h5>
            </div>
            <div class="modal-body">
                <form method="post"  enctype="multipart/form-data" id="formdelivery">
                    @csrf
                    <textarea id="description" name="description" class="w-100"></textarea>
                    <input name="image" id="deliveryImage" type="file">
                    <div style="margin-top: 15px" class="form-group">
                        <label for="name">نام جدید:</label>
                        <input type="text" name="name">
                    </div>

                    <input type="hidden" name="methodId" id="methodId" value="">
                    <p id="error"></p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>

                        <button type="submit" class="btn btn-success" id="updateDewscriptionButton">ویرایش</button>
                    </div>

                </form>


            </div>

        </div>
    </div>
</div>
<!-- add/edit form modal end -->
