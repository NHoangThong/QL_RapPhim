@extends('admin.layout.index')
@section('content')
    
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>@lang('lang.casts')</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <a style="float:right;padding-right:30px;" class="text-light">
                                    <button class=" btn btn-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#cast">@lang('lang.create')</button>
                                </a>
                                <table class="table align-items-center mb-0 ">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">@lang('lang.name')</th>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">@lang('lang.image')</th>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">@lang('lang.birthday')</th>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">@lang('lang.national')</th>
                                        <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('lang.content')</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dienVien as $value)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <h6 class="mb-0 text-sm ">{!! $value['ten_dien_vien'] !!}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if(strstr($value['image'],"https") == "")
                                                    <img style="width: 300px"
                                                    src="{!! $value['hinh_dien_vien'] !!}"
                                                         alt="user1">
                                                @else
                                                    <img style="width: 300px"
                                                         src="{!! $value['hinh_dien_vien'] !!}" alt="user1">
                                                @endif
                                            </td>
                                            
                                            <td class="align-middle text-center">
                                                <h6 class="mb-0 text-sm ">{!! $value['ngaysinh'] !!}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary font-weight-bold">{!! $value['quoc_gia'] !!}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="mb-0 text-sm "
                                                      style="width:200px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical">{!! $value['content'] !!}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ url('admin/dienvien/edit', $value['id_dien_vien'] ) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                   data-original-title="Edit cast" data-bs-target="#editCast{!! $value['id_dien_vien'] !!}"
                                                   data-bs-toggle="modal">
                                                   <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-original-title="Edit director">
                                                    Sửa
                                                </button>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ url('admin/dienvien/delete', $value['id_dien_vien'] ) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa diễn viên này không?')">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('admin.dienvien.edit')
                                    @endforeach
                                    @include('admin.dienvien.create')
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {!! $dienVien->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
@endsection



{{-- @section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete-cast').on('click', function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
                if (confirm("Are you sure you want to remove it?") == true) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            if (data['success']) {
                                // alert(data.success);
                                trObj.parents("tr").remove();
                            } else if (data['error']) {
                                alert(data.error);
                            }
                        }
                    });
                }

            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.file-uploader .img_cast').attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".image-cast").change(function () {
            readURL(this);
        });
    </script>
@endsection --}}
