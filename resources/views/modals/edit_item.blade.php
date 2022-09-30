<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModal" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addItemLabel">{{trans('store.add_item')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="error-text" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.name')}}: </label>
                        <div class="col-md-9">
                            <input id="editItemName" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.description')}}: </label>
                        <div class="col-md-9">
                            <textarea id="editItemDescription" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('store.price')}}: </label>
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
                            <p class="text-warning">L'importation de photo sera disponible bientôt.<p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('general.close')}}</button>
                    <button id="saveItem" type="button" class="btn btn-success">{{trans('general.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", () => {
    $('#saveItem').on('click', function() {
        $.ajax({
            url: "/" + $('html').attr('lang') + "/store/item/edit",
            method: "post",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                toastr.success('L\'item à été ajouté avec succès.', 'Item ajouté');
            },
            error: function(error) {
                toastr.error('Un problème est survenue?', 'Erreur');
            }
        });
    });
});
</script>