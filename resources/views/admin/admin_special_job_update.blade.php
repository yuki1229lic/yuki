@extends('layouts.admin.admin_main_layout')
@section('content')
    <link rel="stylesheet" href=" {{ asset('admin/dist/css/croppie.css') }} ">
    <style>
        .modal-dialog{
            max-width: 900px!important;
        }
        .form-container{
            margin-bottom: 50px;
        }
        .modal{
            z-index: 99999!important;
        }
        .note-editing_area{
            min-height: 300px!important;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container">
                <form role="form" method="POST" action="{{ route('admin.special_update_db') }}" class="form-container">
                    @csrf
                    <input type="hidden" name="special_id" value="{{ $special_detail['id'] }}">
                    <div class="card">
                        <div class="card-body">
                            @foreach(['danger','warning', 'success','info'] as $msg)
                                @if(Session::has('alert-'.$msg))
                                    <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </p>
                                @endif
                            @endforeach

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>特集求人イトル</label>
                                        <input type="text" class="form-control @error('special_title') is-invalid @enderror" name="special_title" value="{{ $special_detail['special_title'] }}">
                                        @error('special_title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>特集求人内容</label>
                                        <textarea class="form-control editor" name="special_content" rows="5">{{ $special_detail['special_content'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">特集求人写真</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="uploadImage" name="uploadImage">
                                                <label class="custom-file-label" for="customFile">ファイルを選択する</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset("images/special") .'/'.$special_detail['special_img'] }}" id="thumbnailDisplay" width="400">
                                    </div>
                                </div>
                                <input type="hidden" name="imagePath" value="{{ $special_detail['special_img'] }}" id="imagepath">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">勤務地</label>
                                    <select name="special_area" class="form-control" id="special_area">
                                        @foreach($areas as $area)
                                            <option value="{{ $area['area_name'] }}">{{ $area['area_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">職種</label>
                                    <select name="special_category" class="form-control" id="special_category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['kind_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <button type="submit" class="btn btn-block btn-primary btn-lg col-md-4 offset-md-4">特集求人変更</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" style="justify-content: center;">
                        <div id="image_demo"></div>
                    </div>
                    <button class="btn btn-success" id="crop_image">画像保存する</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/dist/js/croppie.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.editor').summernote(
                {
                    height: 300,
                }
            );
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:500, height:280, type:'square'
                },
                boundary:{
                    width:700, height:500
                }
            });
            $('#uploadImage').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('image was bind');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });
            $('#crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    var _token = $('input[name=_token]').val()
                    $.ajax({
                        url:'{{ route("admin.special_imageUpload")}}',
                        type: "POST",
                        data:{"image": response, _token: _token },
                        success:function(data) {
                            $('#uploadimageModal').modal('hide');
                            $('#thumbnailDisplay').attr('src','{{ asset("images/special") }}'+ '/' +data);
                            $('#imagepath').val(data);
                        }
                    });
                })
            });
            var area = '{{ $special_detail['special_area'] }}';
            $('#special_area option').each( function (){
                var result1 = $(this).val();
                if( area == result1){
                    $(this).prop("selected",true);
                }
            });
            var category = '{{ $special_detail['special_category'] }}';
            $('#special_category option').each( function (){
                var result2 = $(this).val();
                if( category == result2){
                    $(this).prop("selected",true);
                }
            });
        });
    </script>
@endsection

