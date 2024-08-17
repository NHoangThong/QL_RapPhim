
<!-- Modal -->
<div class="modal fade" id="TheaterEditModal{{ $theater->id_rap }}" tabindex="-1" aria-labelledby="TheaterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TheaterModalLabel">{{ $theater->ten_rap }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/rap/edit', $theater->id_rap) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">@lang('lang.name')</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $theater->ten_rap }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">@lang('lang.address')</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $theater->dia_chi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">@lang('lang.city')</label>
                        <select class="form-select" id="city" name="city" required>
                            <!-- Danh sách các thành phố -->
                            <option value="An Giang" {{ $theater->thanh_pho == 'An Giang' ? 'selected' : '' }}>An Giang</option>
                            <option value="Bắc Giang" {{ $theater->thanh_pho == 'Bắc Giang' ? 'selected' : '' }}>Bắc Giang</option>
                            <option value="Bắc Kạn" {{ $theater->thanh_pho == 'Bắc Kạn' ? 'selected' : '' }}>Bắc Kạn</option>
                            <option value="Bạc Liêu" {{ $theater->thanh_pho == 'Bạc Liêu' ? 'selected' : '' }}>Bạc Liêu</option>
                            <option value="Bắc Ninh" {{ $theater->thanh_pho == 'Bắc Ninh' ? 'selected' : '' }}>Bắc Ninh</option>
                            <option value="Bà Rịa - Vũng Tàu" {{ $theater->thanh_pho == 'Bà Rịa - Vũng Tàu' ? 'selected' : '' }}>Bà Rịa - Vũng Tàu</option>
                            <option value="Bến Tre" {{ $theater->thanh_pho == 'Bến Tre' ? 'selected' : '' }}>Bến Tre</option>
                            <option value="Bình Định" {{ $theater->thanh_pho == 'Bình Định' ? 'selected' : '' }}>Bình Định</option>
                            <option value="Bình Dương" {{ $theater->thanh_pho == 'Bình Dương' ? 'selected' : '' }}>Bình Dương</option>
                            <option value="Bình Phước" {{ $theater->thanh_pho == 'Bình Phước' ? 'selected' : '' }}>Bình Phước</option>
                            <option value="Bình Thuận" {{ $theater->thanh_pho == 'Bình Thuận' ? 'selected' : '' }}>Bình Thuận</option>
                            <option value="Cà Mau" {{ $theater->thanh_pho == 'Cà Mau' ? 'selected' : '' }}>Cà Mau</option>
                            <option value="Cao Bằng" {{ $theater->thanh_pho == 'Cao Bằng' ? 'selected' : '' }}>Cao Bằng</option>
                            <option value="Đắc Lắk" {{ $theater->thanh_pho == 'Đắc Lắk' ? 'selected' : '' }}>Đắc Lắk</option>
                            <option value="Đắc Nông" {{ $theater->thanh_pho == 'Đắc Nông' ? 'selected' : '' }}>Đắc Nông</option>
                            <option value="Điện Biên" {{ $theater->thanh_pho == 'Điện Biên' ? 'selected' : '' }}>Điện Biên</option>
                            <option value="Đồng Nai" {{ $theater->thanh_pho == 'Đồng Nai' ? 'selected' : '' }}>Đồng Nai</option>
                            <option value="Đồng Tháp" {{ $theater->thanh_pho == 'Đồng Tháp' ? 'selected' : '' }}>Đồng Tháp</option>
                            <option value="Gia Lai" {{ $theater->thanh_pho == 'Gia Lai' ? 'selected' : '' }}>Gia Lai</option>
                            <option value="Hà Giang" {{ $theater->thanh_pho == 'Hà Giang' ? 'selected' : '' }}>Hà Giang</option>
                            <option value="Hải Dương" {{ $theater->thanh_pho == 'Hải Dương' ? 'selected' : '' }}>Hải Dương</option>
                            <option value="Hà Nam" {{ $theater->thanh_pho == 'Hà Nam' ? 'selected' : '' }}>Hà Nam</option>
                            <option value="Hà Tây" {{ $theater->thanh_pho == 'Hà Tây' ? 'selected' : '' }}>Hà Tây</option>
                            <option value="Hà Tỉnh" {{ $theater->thanh_pho == 'Hà Tỉnh' ? 'selected' : '' }}>Hà Tỉnh</option>
                            <option value="Hậu Giang" {{ $theater->thanh_pho == 'Hậu Giang' ? 'selected' : '' }}>Hậu Giang</option>
                            <option value="Hòa Bình" {{ $theater->thanh_pho == 'Hòa Bình' ? 'selected' : '' }}>Hòa Bình</option>
                            <option value="Hưng Yên" {{ $theater->thanh_pho == 'Hưng Yên' ? 'selected' : '' }}>Hưng Yên</option>
                            <option value="Khánh Hòa" {{ $theater->thanh_pho == 'Khánh Hòa' ? 'selected' : '' }}>Khánh Hòa</option>
                            <option value="Kiên Giang" {{ $theater->thanh_pho == 'Kiên Giang' ? 'selected' : '' }}>Kiên Giang</option>
                            <option value="Kon Tum" {{ $theater->thanh_pho == 'Kon Tum' ? 'selected' : '' }}>Kon Tum</option>
                            <option value="Lai Châu" {{ $theater->thanh_pho == 'Lai Châu' ? 'selected' : '' }}>Lai Châu</option>
                            <option value="Lâm Đồng" {{ $theater->thanh_pho == 'Lâm Đồng' ? 'selected' : '' }}>Lâm Đồng</option>
                            <option value="Lạng Sơn" {{ $theater->thanh_pho == 'Lạng Sơn' ? 'selected' : '' }}>Lạng Sơn</option>
                            <option value="Lào Cai" {{ $theater->thanh_pho == 'Lào Cai' ? 'selected' : '' }}>Lào Cai</option>
                            <option value="Long An" {{ $theater->thanh_pho == 'Long An' ? 'selected' : '' }}>Long An</option>
                            <option value="Nam Định" {{ $theater->thanh_pho == 'Nam Định' ? 'selected' : '' }}>Nam Định</option>
                            <option value="Nghệ An" {{ $theater->thanh_pho == 'Nghệ An' ? 'selected' : '' }}>Nghệ An</option>
                            <option value="Ninh Bình" {{ $theater->thanh_pho == 'Ninh Bình' ? 'selected' : '' }}>Ninh Bình</option>
                            <option value="Ninh Thuận" {{ $theater->thanh_pho == 'Ninh Thuận' ? 'selected' : '' }}>Ninh Thuận</option>
                            <option value="Phú Thọ" {{ $theater->thanh_pho == 'Phú Thọ' ? 'selected' : '' }}>Phú Thọ</option>
                            <option value="Phú Yên" {{ $theater->thanh_pho == 'Phú Yên' ? 'selected' : '' }}>Phú Yên</option>
                            <option value="Quảng Bình" {{ $theater->thanh_pho == 'Quảng Bình' ? 'selected' : '' }}>Quảng Bình</option>
                            <option value="Quảng Nam" {{ $theater->thanh_pho == 'Quảng Nam' ? 'selected' : '' }}>Quảng Nam</option>
                            <option value="Quảng Ngãi" {{ $theater->thanh_pho == 'Quảng Ngãi' ? 'selected' : '' }}>Quảng Ngãi</option>
                            <option value="Quảng Ninh" {{ $theater->thanh_pho == 'Quảng Ninh' ? 'selected' : '' }}>Quảng Ninh</option>
                            <option value="Quảng Trị" {{ $theater->thanh_pho == 'Quảng Trị' ? 'selected' : '' }}>Quảng Trị</option>
                            <option value="Sóc Trăng" {{ $theater->thanh_pho == 'Sóc Trăng' ? 'selected' : '' }}>Sóc Trăng</option>
                            <option value="Sơn La" {{ $theater->thanh_pho == 'Sơn La' ? 'selected' : '' }}>Sơn La</option>
                            <option value="Tây Ninh" {{ $theater->thanh_pho == 'Tây Ninh' ? 'selected' : '' }}>Tây Ninh</option>
                            <option value="Thái Bình" {{ $theater->thanh_pho == 'Thái Bình' ? 'selected' : '' }}>Thái Bình</option>
                            <option value="Thái Nguyên" {{ $theater->thanh_pho == 'Thái Nguyên' ? 'selected' : '' }}>Thái Nguyên</option>
                            <option value="Thanh Hóa" {{ $theater->thanh_pho == 'Thanh Hóa' ? 'selected' : '' }}>Thanh Hóa</option>
                            <option value="Thừa Thiên Huế" {{ $theater->thanh_pho == 'Thừa Thiên Huế' ? 'selected' : '' }}>Thừa Thiên Huế</option>
                            <option value="Tiền Giang" {{ $theater->thanh_pho == 'Tiền Giang' ? 'selected' : '' }}>Tiền Giang</option>
                            <option value="Trà Vinh" {{ $theater->thanh_pho == 'Trà Vinh' ? 'selected' : '' }}>Trà Vinh</option>
                            <option value="Tuyên Quang" {{ $theater->thanh_pho == 'Tuyên Quang' ? 'selected' : '' }}>Tuyên Quang</option>
                            <option value="Vĩnh Long" {{ $theater->thanh_pho == 'Vĩnh Long' ? 'selected' : '' }}>Vĩnh Long</option>
                            <option value="Vĩnh Phúc" {{ $theater->thanh_pho == 'Vĩnh Phúc' ? 'selected' : '' }}>Vĩnh Phúc</option>
                            <option value="Yên Bái" {{ $theater->thanh_pho == 'Yên Bái' ? 'selected' : '' }}>Yên Bái</option>
                            <option value="Cần Thơ" {{ $theater->thanh_pho == 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
                            <option value="Đà Nẵng" {{ $theater->thanh_pho == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                            <option value="Hải Phòng" {{ $theater->thanh_pho == 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                            <option value="Hà Nội" {{ $theater->thanh_pho == 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                            <option value="Hồ Chí Minh" {{ $theater->thanh_pho == 'Hồ Chí Minh' ? 'selected' : '' }}>Hồ Chí Minh</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                        <button type="submit" class="btn bg-gradient-info">@lang('lang.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>