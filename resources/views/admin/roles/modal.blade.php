<!-- Role Modal -->
<div class="modal modal-slide-in fade" id="roleModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-sm">
        <form method="POST" class="add-new-record modal-content pt-0" id="roleForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="form-group">
                    <label class="form-label" for="name">{{ trans('admin.name') }}:</label>
                    <input id="name" type="text" name="name" class="form-control" required value="{{ old('name') }}"
                        placeholder="{{ trans('admin.name') }}">
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
