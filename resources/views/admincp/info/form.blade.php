@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý thông tin website</div>
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
                   
                    {!! Form::open(['route' => ['info.update',$info->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    
                    
                    
                        <div class="form-group">
                    {!! Form::label('title','Tiêu đề website',[]) !!}
                    {!! Form::text('title',isset($info) ? $info->title :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...']) !!}
                        </div>
                       
                        <div class="form-group">
                    {!! Form::label('description','Mô tả website',[]) !!}
                    {!! Form::textarea('description',isset($info) ? $info->description :'', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                    {!! Form::label('Image','Hình ảnh logo',[]) !!}
                    {!! Form::file('image',['class'=>'form-control-file']) !!}
                    @if(isset($info))
                    <img src="{{asset('uploads/logo/'.$info->logo)}}" alt="" style="width: 150;">
                    @endif
                        </div>
                        <div class="form-group">
                    {!! Form::label('copyright','Copyright',[]) !!}
                    {!! Form::text('copyright',isset($info) ? $info->copyright :'', ['class'=>'form-control','placeholder'=>'Nhập dữ liệu vào...']) !!}
                        </div>

                   
                    {!! Form::submit('Cập nhập thông tin website',['class'=>'btn btn-success']) !!} 
                    
                    {!! Form::close() !!} 
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection
