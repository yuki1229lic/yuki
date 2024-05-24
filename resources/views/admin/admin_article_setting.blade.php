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
                <form role="form" method="POST" action="{{ route('admin.article_add') }}" class="form-container">
                    @csrf
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
                                        <label>ブログタイトル</label>
                                        <input type="text" class="form-control @error('article_title') is-invalid @enderror" name="article_title">
                                        @error('article_title')
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
                                        <label>ブログの内容</label>
                                        <textarea class="form-control editor" name="article_content" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">ブログ写真</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="uploadImage" name="uploadImage">
                                                <label class="custom-file-label" for="customFile">ファイルを選択する</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <img src="" id="thumbnailDisplay" width="400">
                                    </div>
                                </div>
                                <input type="hidden" name="imagePath" value="" id="imagepath">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <button type="submit" class="btn btn-block btn-primary btn-lg col-md-4 offset-md-4">記事追加</button>
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
                        url:'{{ route("admin.article_imageUpload")}}',
                        type: "POST",
                        data:{"image": response, _token: _token },
                        success:function(data) {
                            $('#uploadimageModal').modal('hide');
                            $('#thumbnailDisplay').attr('src','{{ asset("images/blogs") }}'+ '/' +data);
                            $('#imagepath').val(data);
                        }
                    });
                })
            });

        });
    </script>
@endsection

