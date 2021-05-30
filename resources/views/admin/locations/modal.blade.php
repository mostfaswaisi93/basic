<!-- Location Modal -->
<div class="modal modal-slide-in fade" id="locationModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-sm">
        <form method="POST" class="add-new-record modal-content pt-0" id="locationForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="form-group">
                    <label class="form-label" for="title_ar">{{ trans('admin.ar.title') }}:</label>
                    <input id="title_ar" type="text" name="title[ar]" class="form-control" value="{{ old('title.ar') }}"
                        placeholder="{{ trans('admin.ar.title') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="title_en">{{ trans('admin.en.title') }}:</label>
                    <input id="title_en" type="text" name="title[en]" class="form-control" value="{{ old('title.en') }}"
                        placeholder="{{ trans('admin.en.title') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="country_id">{{ trans('admin.country') }}:</label>
                    <select name="country_id" id="country_id" class="form-control">
                        <option value="" selected disabled> {{ trans('admin.all_countries') }} </option>
                        @foreach($countries as $key => $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name_trans }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="city_id">{{ trans('admin.city') }}:</label>
                    <select class="form-control" name="city_id" id="city_id">
                        <option value="" selected disabled> {{ trans('admin.all_cities') }} </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="district_id">{{ trans('admin.district') }}:</label>
                    <select class="form-control" name="district_id" id="district_id">
                        <option value="" selected disabled> {{ trans('admin.all_districts') }} </option>
                    </select>
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