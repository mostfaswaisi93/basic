<!-- Patient Modal -->
<div class="modal modal-slide-in fade" id="patientModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog sidebar-lg">
        <form method="POST" class="add-new-record modal-content pt-0" id="patientForm" enctype="multipart/form-data">
            @csrf
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body flex-grow-1">
                <span id="form_result"></span>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="full_name">{{ trans('admin.ar.full_name') }}:</label>
                        <input id="full_name_ar" type="text" name="full_name[ar]" class="form-control"
                            value="{{ old('full_name.ar') }}" placeholder="{{ trans('admin.ar.full_name') }}">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="full_name">{{ trans('admin.en.full_name') }}:</label>
                        <input id="full_name_en" type="text" name="full_name[en]" class="form-control"
                            value="{{ old('full_name.en') }}" placeholder="{{ trans('admin.en.full_name') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="dob">{{ trans('admin.date_of_birth') }}:</label>
                        <input id="dob" type="text" name="dob" class="form-control flatpickr-basic"
                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="phone">{{ trans('admin.phone') }}:</label>
                        <input id="phone" type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="{{ trans('admin.phone') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label" for="gender">{{ trans('admin.gender') }}:</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">--</option>
                            @foreach ($genders as $gender)
                            <option value="{{ $gender->name_trans }}"
                                {{ old('gender') == $gender->id ? 'selected' : '' }}>
                                {{ $gender->name_trans }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="blood_group">{{ trans('admin.blood_group') }}:</label>
                        <select class="form-control" name="blood_group" id="blood_group">
                            @foreach ($blood_groups as $blood_group)
                            <option value="{{ $blood_group->name_trans }}"
                                {{ old('blood_group') == $blood_group->id ? 'selected' : '' }}>
                                {{ $blood_group->name_trans }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label"
                            for="user_id">{{ trans('admin.username') }}/{{ trans('admin.doctor') }}:</label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="">--</option>
                            @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('user_id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->fullName }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label" for="address">{{ trans('admin.address') }}:</label>
                        <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}"
                            placeholder="{{ trans('admin.address') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="notes">{{ trans('admin.notes') }}:</label>
                    <textarea class="form-control" cols="40" id="notes" name="notes" rows="4" value="{{ old('notes') }}"
                        placeholder="{{ trans('admin.notes') }}"></textarea>
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