<!-- Category Modal -->
<div class="modal modal-slide-in fade" id="categoryModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-sm">
        <form method="POST" class="add-new-record modal-content pt-0" id="categoryForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="form-group">
                    <label class="form-label" for="name_ar">{{ trans('admin.ar.name') }}:</label>
                    <input id="name_ar" type="text" name="name[ar]" class="form-control" value="{{ old('name.ar') }}"
                        placeholder="{{ trans('admin.ar.name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="name_en">{{ trans('admin.en.name') }}:</label>
                    <input id="name_en" type="text" name="name[en]" class="form-control" value="{{ old('name.en') }}"
                        placeholder="{{ trans('admin.en.name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="price">{{ trans('admin.user') }}:</label>
                    <input id="price" type="text" name="price" class="form-control" value="{{ old('price') }}"
                        placeholder="{{ trans('admin.user') }}">
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
