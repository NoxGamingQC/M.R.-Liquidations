<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModal" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-8">
                    <h4 class="modal-title" id="editItemLabel">{{trans('store.edit_item')}}</h4>
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
                            <input id="editItemName" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.description')}}:<label class="text-primary" style="font-size: 20px">*</label> </label>
                        <div class="col-md-9">
                            <textarea id="editItemDescription" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.price')}}:<label class="text-primary" style="font-size: 20px">*</label> </label>
                        <div class="col-md-3">
                            <input id="editItemPrice" class="form-control" />
                        </div>
                        <label class="col-md-3 control-label">{{trans('store.stock')}}: </label>
                        <div class="col-md-3">
                            <input id="editItemStock" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.categories')}}: </label>
                        <div class="col-md-9">
                            <select class="selectpicker form-control" title="{{trans('store.categories')}}" id="editItemCategories"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">
                                <label class="control-label">{{trans('store.isAvailable')}}:&nbsp</label><input id="editItemIsAvailable" type="checkbox" />
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">
                                <label class="control-label">{{trans('store.isHidden')}}:&nbsp</label><input id="editItemIsHidden" type="checkbox" />
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <p class="text-danger"><label class="text-primary" style="font-size: 20px">*</label>{{trans('general.required_fields')}}</p>
                            <p class="text-info">{{trans('store.place_to_edit_picture')}}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a id="editItemPage" class="btn btn-primary" href="">{{trans('management.edit_page')}}</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('general.close')}}</button>
                            <button id="saveItemEdit" type="button" class="btn btn-success">{{trans('general.save')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", () => {
    $('#saveItemEdit').on('click', function() {
        $.ajax({
            url: "/store/item/edit",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $('#editItemID').val(),
                name: $('#editItemName').val(),
                description: $('#editItemDescription').val(),
                price: $('#editItemPrice').val(),
                stock: $('#editItemStock').val(),
                isAvailable: $('#editItemIsAvailable').is(':checked'),
                isHidden: $('#editItemIsHidden').is(':checked')
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
});
</script>