<form action="{{route('locphim')}}" method="get">
                        <style type="text/css">
                           .stylish_filter{
                              border: 0;
                              background: #12171b;
                              color: #fff;
                           }
                           .btn_filter{
                              border: 0;
                              background: #12171b;
                              color: #fff;
                              padding:  10px 20px;
                           }

                        </style>
                     <div class="col-md-3">
                     <div class="form-group">
                        
                      
                             <select class="form-control stylish_filter"name="order" id="exampleFormControlSelect1">
                             <option value="">--Sắp xếp--</option>
                               <option value="date">Ngày đăng</option>
                               <option value="year_release">Năm sản xuất</option>
                               <option value="name_a_z">Tên phim</option>
                               <option value="watch_views">Lượt xem</option>
                              
                              </select>
                              </div>
                              </div>
                                 <div class="col-md-2">
                     <div class="form-group">
                        
                      
                             <select class="form-control stylish_filter"name="genre" id="exampleFormControlSelect1">
                             <option value="">--Thể loại--</option>
                             @foreach ($genre_home as $key => $gen_filter)
                               <option {{(isset($_GET['genre']) && $_GET['genre']==$gen_filter->id) ? 'selected' : ''}} value="{{$gen_filter->id}}">{{$gen_filter->title}}</option>
                               @endforeach
                              
                              </select>
                              </div>
                              </div>
                                 <div class="col-md-2">
                     <div class="form-group">
                        
                      
                             <select class="form-control stylish_filter"name="country" id="exampleFormControlSelect1">
                             <option value="">--Quốc gia--</option>
                             @foreach ($country_home as $key => $cou_filter)
                               <option {{(isset($_GET['country']) && $_GET['country']==$cou_filter->id) ? 'selected' : ''}} value="{{$cou_filter->id}}">{{$cou_filter->title}}</option>
                               @endforeach
                              </select>
                              </div>
                              </div>
                                 <div class="col-md-3">
                     <div class="form-group">
                        
                      
                     {!! Form::selectYear('year',2020,2025,isset($_GET['year']) ? $_GET['year'] : '',['class'=>'form-control stylish_filter','placeholder'=>'--Năm phim--']) !!}
                              </div>
                              
                              </div>
                              <div class="col-md-2">
                              <input type="submit" class="btn btn-sm btn_filter" value="Lọc phim">
                              </div>
                                 
                     
                   
                     </form>