<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModal" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-8">
                    <h4 class="modal-title" id="addItemLabel">{{trans('store.add_item')}}</h4>
                </div>
                <div class="col-md-4">
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size: 30px">
                        <span class="error-text" aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form class="form-horizontal">
            {{ csrf_field() }}
                <div class="modal-body">
                    <input id="editItemID" type="hidden" class="form-control" />
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.name')}}:<label class="text-primary" style="font-size: 20px">*</label> </label>
                        <div class="col-md-9">
                            <input id="addItemName" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.description')}}:<label class="text-primary" style="font-size: 20px">*</label> </label>
                        <div class="col-md-9">
                            <textarea id="addItemDescription" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.price')}}:<label class="text-primary" style="font-size: 20px">*</label></label>
                        <div class="col-md-3">
                            <input id="addItemPrice" class="form-control" />
                        </div>
                        <label class="col-md-3 control-label">{{trans('store.stock')}}: </label>
                        <div class="col-md-3">
                            <input id="addItemStock" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.categories')}}: </label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control" title="{{trans('store.categories')}}" id="addItemCategories"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">
                                <label class="control-label">{{trans('store.isAvailable')}}:&nbsp</label><input id="addItemIsAvailable" type="checkbox" />
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">
                                <label class="control-label">{{trans('store.isHidden')}}:&nbsp</label><input id="addItemIsHidden" type="checkbox" />
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label for="picture">{{trans('store.picture')}}</label>
                                <input class="form-control disabled" id="addItemPicture" type="file" accept="image/*" disabled />
                            </div>
                            <div class="col-md-6 text-center">
                                <img id="newItemPicture" src="" width="100%"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <p class="text-warning">{{trans('store.recommended_picture_ratio')}}</p>
                            <p class="text-danger"><label class="text-primary" style="font-size: 20px">*</label>{{trans('general.required_fields')}}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('general.close')}}</button>
                    <button id="addNewItem" type="button" class="btn btn-success">{{trans('general.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", () => {
    $('#addNewItem').on('click', function() {
        $.ajax({
            url: "/store/item/add",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $('#addItemID').val(),
                name: $('#addItemName').val(),
                description: $('#addItemDescription').val(),
                price: $('#addItemPrice').val(),
                stock: $('#addItemStock').val(),
                isAvailable: $('#addItemIsAvailable').is(':checked'),
                isHidden: $('#addItemIsHidden').is(':checked'),
                //picture: $('#newItemPicture').attr('src')
            },
            success: function() {
                console.log('L\'item à été modifier avec succès.');
                toastr.success('L\'item à été modifier avec succès.', 'Item modifier');
                window.location.reload();
            },
            error: function(error) {
                console.log('Un problème est survenue');
                toastr.error('Un problème est survenue', 'Erreur');
            }
        });
    });

    var itemInput = document.getElementById("addItemPicture");
    var itemPicture = document.getElementById("newItemPicture");

    const convertBase64 = (file) => {
        return new Promise((resolve, reject) => {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);

            fileReader.onload = () => {
                resolve(fileReader.result);
            };

            fileReader.onerror = (error) => {
                reject(error);
            };
        });
    };

    const uploadImage = async (event) => {
        const file = event.target.files[0];
        const base64 = await convertBase64(file);
        itemPicture.src = base64;
    };

    itemInput.addEventListener("change", (e) => {
        uploadImage(e);
    });
});
</script>