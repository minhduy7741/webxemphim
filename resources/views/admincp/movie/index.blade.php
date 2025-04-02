@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    <a href="{{route('movie.create')}}" class="btn btn-primary">Thêm phim</a>
        <div class="col-md-12">
        <table class="table" id="tablephim">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên phim</th>
      <th scope="col">Tập phim</th>
      <th scope="col">Tags</th>
      <th scope="col">Thời lượng phim</th>
      <th scope="col">Image</th>
      <th scope="col">Hot</th>
      <th scope="col">Định dạng</th>
      <th scope="col">Phụ đề</th>
      <!-- <th scope="col">Description</th> -->
      <th scope="col">Slug</th>
      <th scope="col">Active/Inactive</th>
      <th scope="col">Category</th>
      <th scope="col">Country</th>
      <th scope="col">Số tập</th>
      <th scope="col">Genre</th>
      <th scope="col">Thuộc phim</th>
      <th scope="col">Ngày tạo</th>
      <th scope="col">Ngày cập nhập</th>
      <th scope="col">Năm phim</th>
      <th scope="col">Season</th>
      <th scope="col">Top views</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
    @foreach($list as $key => $cate)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$cate->title}}</td>
      <td><a href="{{route('add-episode', [$cate->id])}}" class="btn btn-primary"> Thêm Tập phim</a>
      @foreach($cate->episode as $key => $epi)
      <span class="badge badge-dark"><a href=""style ="color:#fff">{{$epi->episode}}</a></span>
    @endforeach
    </td>
      <td>
        @if(strlen($cate->tags)>150)
        @php
        $tags = substr($cate->tags,0,100);
       
        echo $tags.'...';
        @endphp
       
        @endif
      </td>
      <td>{{$cate->thoiluong}}</td>
      <td><img src="{{asset('uploads/movie/'.$cate->image)}}" alt="" style="width: 100px"></td>
      <td>
<!-- @if($cate->phim_hot==0)
Không

@else
Có
@endif -->
<select class="phimhot_choose" id="{{$cate->id}}">
    @if($cate->phim_hot==0)
    <option  value="1">Hot</option>
    <option  selected value="0">Không</option>
    @else
    <option selected value="1">Hot</option>
    <option   value="0">Không</option>
    @endif
    
</select>

    </td>
    <td>
<!-- @if($cate->resolution==0)
HD

@elseif($cate->resolution==1)
SD
@elseif($cate->resolution==2)
HDCam
@elseif($cate->resolution==3)
Cam
@elseif($cate->resolution==4)
FullHD
@elseif($cate->resolution==5)
Trailer

@endif -->
@php
$option = array(
    '0' => 'HD',
    '1' => 'SD',
    '2' => 'HDCam',
    '3' => 'Cam',
    '4' => 'FullHD',
    '5' => 'Trailer',
);
@endphp
<select class="resolution_choose" id="{{$cate->id}}">
    
@foreach($option as $key => $resolution)
    <option {{$cate->resolution==$key ? 'selected' : ''}} value="{{$key}}">{{$resolution}}</option>
    @endforeach
   
    
</select>


</td>


    <td>
<!-- @if($cate->phude==0)
phụ đề

@else
Thuyết minh
@endif -->
<select class="phude_choose" id="{{$cate->id}}">
    @if($cate->phude==0)
    <option  value="1">Thuyết minh</option>
    <option  selected value="0">Phụ đề</option>
    @else
    <option selected value="1">Thuyết minh</option>
    <option   value="0">Phụ đề</option>
    @endif
    
</select>
    </td>
      
      <!-- <td>{{$cate->description}}</td> -->
      <td>{{$cate->slug}}</td> 
      <td>
<!-- @if($cate->status)
Hiển thị

@else
Không hiển thị
@endif -->
  <select class="trangthai_choose" id="{{$cate->id}}">
    @if($cate->status==0)
    <option  value="0">Không hiển thị</option>
    <option  selected value="1">Hiển thị</option>
    @else
    <option  value="0">Không hiển thị</option>
    <option selected value="1">Hiển thị</option>
    @endif
  </select>
    </td>
    <td>
      
      {!! Form::select('category_id',$category,isset($cate->category->id) ? $cate->category_id :'', ['class'=>'form-control category_choose','id'=>$cate->id]) !!}

    </td> 
    <td>
      
      {!! Form::select('country_id',$country,isset($cate->country->id) ? $cate->country_id :'', ['class'=>'form-control country_choose','id'=>$cate->id]) !!}

    </td>
    <td>
     {{$cate->episode_count}} / {{$cate->sotap}} 

    </td>
    
    <td>
    @foreach($cate->movie_genre as $gen)
       <span class="badge badge-dark">{{$gen->title}}</span>
    @endforeach
    </td>
    <td>
      <!-- @if($cate->thuocphim=='phimle')
      Phim lẻ
      @else
      Phim bộ
      @endif -->
      <select class="thuocphim_choose" id="{{$cate->id}}">
    @if($cate->thuocphim=='phimbo')
    <option value="phimle">Phim lẻ</option>
    <option selected value="phimbo">Phim bộ</option>
    @else
    <option   selected value="phimle">Phim lẻ</option>
    <option  value="phimbo">Phim bộ</option>
    @endif
  </select>
    </td>
    <td>{{$cate->ngaytao}}</td>
    <td>{{$cate->ngaycapnhap}}</td>
    <td>
      <form method "POST">
      @csrf
    {!! Form::selectYear('year',2020,2025,isset($cate->year) ? $cate->year : '',['class'=>'select_year','id'=>$cate->id,'placeholder'=>'--Năm phim--']) !!}
    </form>
    </td>
    <td>
    {!! Form::selectRange('season',0,20,isset($cate->season) ? $cate->season :'', ['class'=>'select_season','id'=>$cate->id,'placeholder'=>'--Season--']) !!}
    </td>
    <td>
    {!! Form::select('topview',['0'=>'Ngày','1'=>'Tuần','2'=>'Tháng'],isset($cate->topview) ? $cate->topview :'', ['class'=>'select-topview','id'=>$cate->id,'placeholder'=>'--Top views--']) !!}

    </td>
    <td>
    {!! Form::open(['method'=>'DELETE','route'=>['movie.destroy',$cate->id],'onsubmit'=>'return confirm("Bạn chắc chắn muốn xóa chứ ?") ']) !!}
    {!! Form::submit('Xóa',['class'=>'btn btn-danger']) !!}
    {!! Form::close() !!}
    <a href="{{route('movie.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
    </td>
    </tr>
    @endforeach
  </tbody>
</table>
        </div>
    </div>
</div>
@endsection
