<div class="modal fade" id="comboEdit_{{ $combo->id_combo }}" tabindex="-1" aria-labelledby="combo_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="combo_title">Combo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="admin/combo/edit/{{$combo->id_combo}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name_{{$combo->id_combo}}">@lang('lang.name')</label>
                                    <input id="name_{{$combo->id_combo}}" class="form-control" type="text" value="{{ $combo->ten_combo }}" name="name"
                                           autocomplete="off"
                                           placeholder="@lang('lang.type') @lang('lang.name')" aria-label="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price_{{$combo->id_combo}}">@lang('lang.price')</label>
                                    <input id="price_{{$combo->id_combo}}" class="form-control" type="number" name="price" value="{{ $combo->gia }}"
                                           placeholder="@lang('lang.type') @lang('lang.price')" aria-label="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group file-uploader">
                                    <label for="img_{{$combo->id_combo}}">@lang('lang.image')</label>
                                    <input id="img_{{$combo->id_combo}}" type='file' name='Image' class="form-control image-combo">
                                    @if(strstr($combo->image,"https") == "")
                                        <img style="width: 100px" alt="..." class="img-thumbnail"
                                             src="{{$combo->hinh}}">
                                    @else
                                        <img style="width: 100px" alt="..." class="img-thumbnail"
                                             src="{!! $combo->hinh !!}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 food_group" id="food_group_{{$combo->id_combo}}">
                                <span class="form-label">Foods</span>
                                @foreach($combo->foods as $foodOfCombo)
                                    <div class="input-group m-1">
                                        <span class="input-group-text text-black-50">@lang('lang.food'): </span>
                                        <select name='food[]' class="form-select" aria-label="food">
                                            @foreach($foods as $food)
                                                <option value="{{$food->id_food}}" @if($food->id_food == $foodOfCombo->id_food) selected @endif>
                                                    {{$food->ten_food}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text text-black-50">@lang('lang.quantity'): </span>
                                        <input type="number" value="{{$foodOfCombo->pivot->so_luong}}" name="quantity[]" class="form-control"
                                               placeholder="quantity..." aria-label="quantity">
                                        <button type="button" class="btn btn-danger mb-0 delete_food"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                @endforeach
                                <!-- Phần tử mẫu -->
                                <template id="food_template_{{$combo->id_combo}}">
                                    <div class="input-group m-1">
                                        <span class="input-group-text text-black-50">@lang('lang.food'): </span>
                                        <select name='food[]' class="form-select" aria-label="food">
                                            @foreach($foods as $food)
                                                <option value="{{$food->id_food}}">{{$food->ten_food}}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text text-black-50">@lang('lang.quantity'): </span>
                                        <input type="number" name="quantity[]" class="form-control" placeholder="quantity..." aria-label="quantity">
                                        <button type="button" class="btn btn-danger mb-0 delete_food"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </template>
                            </div>
                            <button type="button" class="btn m-1 btn-primary add_food" data-combo-id="{{$combo->id_combo}}">ADD FOOD</button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('lang.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add_food').forEach(function(button) {
        button.addEventListener('click', function() {
            // Lấy ID combo từ data attribute của nút
            var comboId = this.getAttribute('data-combo-id');
            
            // Lấy container của nhóm món ăn dựa trên ID combo
            var foodGroup = document.getElementById('food_group_' + comboId);
            
            // Kiểm tra xem đã thêm phần tử mới chưa
            if (!foodGroup.getAttribute('data-added')) {
                // Lấy phần tử mẫu và sao chép nó
                var template = document.getElementById('food_template_' + comboId);
                var newInputGroup = template.content.cloneNode(true).querySelector('.input-group');
                
                // Thêm nhóm input mới vào container của nhóm món ăn
                foodGroup.appendChild(newInputGroup);
                
                // Thêm sự kiện click vào nút xóa của nhóm input mới
                newInputGroup.querySelector('.delete_food').addEventListener('click', function() {
                    newInputGroup.remove();
                });

                // Đánh dấu rằng đã thêm phần tử mới
                foodGroup.setAttribute('data-added', true);
            }
        });
    });

    // Thêm sự kiện click vào các nút xóa hiện có
    document.querySelectorAll('.delete_food').forEach(function(button) {
        button.addEventListener('click', function() {
            button.closest('.input-group').remove();
        });
    });
});

</script>