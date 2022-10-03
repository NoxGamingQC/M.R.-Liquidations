<div class="modal fade" id="showItemModal" tabindex="-1" aria-labelledby="showItemModal" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-8">
                    <h4 class="modal-title" id="showItemName"></h4>
                </div>
                <div class="col-md-4">
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size: 30px">
                        <span class="error-text" aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="image">
                            <img id="showItemPicture" width="40%" style="box-sizing: border-box;float: right; margin-left:5%;" hidden />
                            <img id="noItemPicture" src="/img/no-image.png" width="40%" style="box-sizing: border-box;float: right; margin-left:5%;" hidden />
                        </div> 
                        <p id="showItemDescription" class="text-justify" style="box-sizing: border-box;"></p>
                    </div>
                    <div class="col-md-12">
                        <hr />
                    </div>
                    <div class="col-md-6">
                        <p>{{trans('store.stock_left')}}: <b id="showItemStock"></b></p>
                    </div>
                    <div class="col-md-6">
                    <p>{{trans('store.price')}}: <b id="showItemPrice"></b></p>
                    </div>
                </div>
            </div>
            <div class="loupe"></div>
            <div class="modal-footer">
                <div class="col-md-6 text-left">
                    <a type="button" id="showItemSeeMoreBtn" class="btn btn-info">{{trans('general.see_more')}}</a>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('general.close')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>