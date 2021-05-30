<!-- Drug Modal -->
<div class="modal modal-slide-in fade" id="drugModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-sm">
        <form method="POST" class="add-new-record modal-content pt-0" id="drugForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="form-group">
                    <label class="form-label" for="trade_name">{{ trans('admin.trade_name') }}:</label>
                    <input id="trade_name" type="text" name="trade_name" class="form-control"
                        value="{{ old('trade_name') }}" placeholder="{{ trans('admin.trade_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="generic_name">{{ trans('admin.generic_name') }}:</label>
                    <input id="generic_name" type="text" name="generic_name" class="form-control"
                        value="{{ old('generic_name') }}" placeholder="{{ trans('admin.generic_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="notes">{{ trans('admin.notes') }}:</label>
                    <textarea class="form-control" cols="40" id="notes" name="notes" rows="5"
                        value="{{ old('notes') }}" placeholder="{{ trans('admin.notes') }}"></textarea>
                </div>
                <input type="hidden" name="action" id="action" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <button type="submit" class="btn btn-primary data-submit mr-1" id="action_button" name="action_button"
                    value="Add">
                    {{ trans('admin.save') }}
                </button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    {{ trans('admin.cancel') }}
                </button>
            </div>
        </form>
    </div>
</div>