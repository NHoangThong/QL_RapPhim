<form action="admin/tintuc/edit/{!! $value['id_tin_tuc'] !!}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="editNews{!! $value['id_tin_tuc'] !!}" tabindex="-1" aria-labelledby="news_title" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="news_title">{!! $value['name'] !!}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">@lang('lang.title')</label>
                                    <input class="form-control" type="text" value="{!! $value['tieu_de'] !!}" name="title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group file-uploader">
                                    <label for="example-text-input" class="form-control-label">@lang('lang.image')</label>
                                    <input type='file' name='Image' class="form-control image-news">
                                    @if(strstr($value['hinh_tin_tuc'],"https") == "")
                                        <img style="width: 300px"
                                             src="{!! $value['hinh_tin_tuc'] !!}."
                                             class="img_news"
                                             alt="user1">
                                    @else
                                        <img style="width: 300px"
                                             src="{!! $value['hinh_tin_tuc'] !!}"
                                             class="img_news"alt="user1">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">@lang('lang.content')</label>
                                    <textarea class="form-control" name="contents" id="editor">{!! $value['content'] !!}</textarea>
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
