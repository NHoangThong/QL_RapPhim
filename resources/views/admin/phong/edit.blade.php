<form action="{{ url('admin/phong/edit', $room['id_phong']) }}" method="POST">
    @csrf
    <div class="modal fade" id="editRoom{!! $room['id_phong'] !!}" tabindex="-1" aria-labelledby="room_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="room_title">{{ $room['ten_phong'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">@lang('lang.room_name')</label>
                                    <input class="form-control" type="text" value="{{ $room['ten_phong'] }}" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roomType" class="form-control-label">@lang('lang.room_type')</label>
                                    <select class="form-select" id="roomType" name="roomType">
                                        @foreach($roomTypes as $roomType)
                                            <option value="{{ $roomType->id_loai_phong }}" {{ $room['id_loai_phong'] == $roomType->id_loai_phong ? 'selected' : '' }}>{{ $roomType->ten_loai_phong }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="row" class="form-label"> @lang('lang.col_number')</label>
                                    <input class="form-control" id="row" type="number" name="row" value="{{ old('row', ord($room->row))-65 }}" min="0"  max="24" placeholder="type row...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="col" class="form-control-label">@lang('lang.row_number')</label>
                                    <input class="form-control" id="col" type="number" name="col" value="{{ old('col', $room->col) }}" min="0" max="50" placeholder="type col...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    
                                    <input class="form-control" type="hidden" value="{{ $room['id_rap'] }}" name="theaterId" id="theaterId">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
                </div>

            </div>
        </div>
    </div>
</form>