@extends('admin.layout.index')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>@lang('lang.room')</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div style="float:right;padding-right:30px;">
                            <a href="{{ url('admin/rap') }}" class="text-light">
                                <button class="btn btn-primary float-right mb-3">
                                    @lang('lang.back_to_theater')
                                </button>
                            </a>
                        </div>
                        @foreach($theaters as $theater)
                        <a style="float:right;padding-right:30px;" class="text-light">
                            <button class="btn btn-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#RoomCreateModal_Theater_{{ $theater->id_rap }}">
                                @lang('lang.create')
                            </button>
                        </a>
                        @endforeach
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">@lang('lang.name')</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">@lang('lang.room_type')</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('lang.status')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <h6 class="mb-0 text-sm">{{ $room->ten_phong }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="mb-0 text-sm">{{ $room->roomType->ten_loai_phong }}</h6>
                                        </td>
                                        <td id="status{!! $room['id_food'] !!}" class="align-middle text-center text-sm">
                                            <form action="{{ route('changeStatusPhong') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="phong_id" value="{{ $room['id_phong'] }}">
                                                @if($room['trang_thai'] == 1)
                                                    <input type="hidden" name="active" value="0">
                                                    <button type="submit" class="btn_active" style="border: none; background: none;">
                                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                                    </button>
                                                @else
                                                    <input type="hidden" name="active" value="1">
                                                    <button type="submit" class="btn_active" style="border: none; background: none;">
                                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ url('admin/phong/edit', $room['id_phong']) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" 
                                            data-original-title="Edit director" data-bs-target="#editRoom{!! $room['id_phong'] !!}"
                                            data-bs-toggle="modal">
                                                <button type="button" class="btn btn-info btn-xs" class="btn btn-info btn-xs" data-toggle="tooltip" data-original-title="Edit room">
                                                    Sửa
                                                </button>
                                            </a>

                                           
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ url('admin/phong/delete', $room['id_phong']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('admin.phong.edit')
                                @endforeach
                            </tbody>
                        </table>
                        @include('admin.phong.create')
                        
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {!! $rooms->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection