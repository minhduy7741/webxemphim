@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>
                   @if($errors->any())
                   <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                   </div>
                   @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($category))
                    {!! Form::open(['route' => 'category.store','method'=>'POST']) !!}
                    @else
                    {!! Form::open(['route' => ['category.update',$category->id],'method'=>'PUT']) !!}
                    @endif
                        <div class="form-group">
                    {!! Form::label('title','Title',[]) !!}
                    {!! Form::text('title',isset($category) ? $category->title :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('slug','Slug',[]) !!}
                    {!! Form::text('slug',isset($category) ? $category->slug :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('description','Description',[]) !!}
                    {!! Form::textarea('description',isset($category) ? $category->description :'', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('Active','Active',[]) !!}
                    {!! Form::select('status',['1'=>'Hiển thị','0'=>'Không'],isset($category) ? $category->status :'', ['class'=>'form-control']) !!}
                        </div>

                    @if(!isset($category))
                    {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success']) !!}   
                    @else
                    {!! Form::submit('Cập nhập',['class'=>'btn btn-success']) !!} 
                    @endif
                    {!! Form::close() !!} 
                </div>
            </div>
            <table class="table" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên phim</th>
      <th scope="col">Slug</th>
      <th scope="col">Tên chính thức</th>
      <th scope="col">Hình ảnh phim</th>
      <th scope="col">Hình ảnh poster</th>
      
      <th scope="col">ID</th>
      <th scope="col">Year</th>
      <th scope="col">Quản lý</th>

      
      
    </tr>
  </thead>
  <tbody class="order_position">
    @foreach($resp['items'] as $key => $res)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$res['name']}}</td>
      <td>{{$res['slug']}}</td>
      <td>{{$res['origin_name']}}</td> 
      <td><img src="{{$resp['pathImage'].$res['thumb_url']}}" alt="" style="width: 100px; height: 100px;"></td>
      <td><img src="{{$resp['pathImage'].$res['poster_url']}}" alt="" style="width: 100px; height: 100px;"></td>
      <td>{{$res['_id']}}</td> 
      <td>{{$res['year']}}</td>
      <td>

    </tr>
    @endforeach
  </tbody>
</table>
        </div>
    </div>
</div>
@endsection
