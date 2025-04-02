@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>
                <div class="card-header">Quản lý phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($movie))
                    {!! Form::open(['route' => 'movie.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' => ['movie.update',$movie->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif
                        <div class="form-group">
                    {!! Form::label('title','Title',[]) !!}
                    {!! Form::text('title',isset($movie) ? $movie->title :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('sotap','Số tập phim',[]) !!}
                    {!! Form::text('sotap',isset($movie) ? $movie->sotap :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('thoiluong','Thời lượng phim',[]) !!}
                    {!! Form::text('thoiluong',isset($movie) ? $movie->thoiluong :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('Tên phim tiếng anh','Tên phim tiếng anh',[]) !!}
                    {!! Form::text('name_eng',isset($movie) ? $movie->name_eng :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('trailer','Trailer',[]) !!}
                    {!! Form::text('trailer',isset($movie) ? $movie->trailer :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('slug','Slug',[]) !!}
                    {!! Form::text('slug',isset($movie) ? $movie->slug :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('description','Description',[]) !!}
                    {!! Form::textarea('description',isset($movie) ? $movie->description :'', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('tags','Tags phim',[]) !!}
                    {!! Form::textarea('tags',isset($movie) ? $movie->tags :'', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('status','Trạng thái',[]) !!}
                    {!! Form::select('status',['1'=>'Hiển thị','0'=>'Không hiển thị'],isset($movie) ? $movie->status :'', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('resolution','Định dạng',[]) !!}
                    {!! Form::select('resolution',['0'=>'HD','1'=>'SD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer'],isset($movie) ? $movie->resolution :'', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('phude','Phụ đề',[]) !!}
                    {!! Form::select('phude',['1'=>'Thuyết minh','0'=>'Phụ đề'],isset($movie) ? $movie->phude :'', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('Category','Category',[]) !!}
                    {!! Form::select('category_id',$category,isset($movie) ? $movie->category_id :'', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('thuocphim','Thuộc phim',[]) !!}
                    {!! Form::select('thuocphim',['phimle'=>'Phim lẻ','phimbo'=>'Phim bộ'],isset($movie) ? $movie->thuocphim :'', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('Country','Country',[]) !!}
                    {!! Form::select('country_id',$country,isset($movie) ? $movie->country_id :'', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('Genre','Genre',[]) !!}<br>
                    <!-- {!! Form::select('genre_id',$genre,isset($movie) ? $movie->genre_id :'', ['class'=>'form-control']) !!} -->
                     @foreach($list_genre as $key =>$gen)
                     @if(isset($movie))
                     {!! Form::checkbox('genre[]' , $gen->id ,isset($movie_genre) && $movie_genre->contains($gen->id)? true :false)   !!}
                     @else
                     {!! Form::checkbox('genre[]' , $gen->id ,'')  !!}
                     @endif
                     {!! Form::label('genre', $gen->title) !!}
                     @endforeach 
                        </div> 
                        <div class="form-group">
                    {!! Form::label('Hot','Hot',[]) !!}
                    {!! Form::select('phim_hot',['1'=>'Có','0'=>'Không'],isset($movie) ? $movie->phim_hot :'', ['class'=>'form-control']) !!}   
                        </div>
                        <div class="form-group">
                    {!! Form::label('Image','Image',[]) !!}
                    {!! Form::file('image',['class'=>'form-control-file']) !!}
                    @if(isset($movie))
                    <img src="{{asset('uploads/movie/'.$movie->image)}}" alt="" style="width: 100%;">
                    @endif
                        </div>

                    @if(!isset($movie))
                    {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success']) !!}   
                    @else
                    {!! Form::submit('Cập nhập',['class'=>'btn btn-success']) !!} 
                    @endif
                    {!! Form::close() !!} 
                </div>
            </div>
            
   
        </div>
    </div>
</div>
@endsection
