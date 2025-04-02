<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use Carbon\Carbon;
use File;
use Storage;
use App\Models\Info;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->category_id = $data['category_id'];
        $movie->save();
        
    }
    public function country_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
        
    }
    public function trangthai_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->status = $data['trangthai_val'];
        $movie->save();
        
    }
    public function thuocphim_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->thuocphim = $data['thuocphim_val'];
        $movie->save();
        
    }
    public function phude_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->phude = $data['phude_val'];
        $movie->save();
    }
    public function phimhot_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->phim_hot = $data['phimhot_val'];
        $movie->save();
    }
    public function resolution_choose(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->resolution = $data['resolution_val'];
        $movie->save();
    }
    public function index()

    {
        $list = Movie::with('category','country','movie_genre','genre')->withCount('episode')->orderBy('id','desc')->get(); 
        // return response()->json($list);
        
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'movies.json',json_encode($list));

        return view('admincp.movie.index',compact('list','category','country'));
    }
    public function update_year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function update_season(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }
    public function update_topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }   
    public function filter_topview(Request $request){
        $data = $request->all();
        $moview =Movie::where('topview',$data['value'])->orderBy('ngaycapnhap','desc')->take(20)->get();
        $output ='';
        foreach($moview as $key => $mov){
            if($mov->resolution==0){
                $text ='HD';
            }elseif($mov->resolution==1){
                $text ='SD';
            }elseif($mov->resolution==2){
                $text ='HDCAM';
            }elseif($mov->resolution==3){
                $text ='Cam';  
            }elseif($mov->resolution==4){
                $text ='FullHD';
            }elseif($mov->resolution==5){
                $text ='Trailer';
            }
            $output.='<div class="item">
                              <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                                 <div class="item-link">
                                    <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                                    <span class="is_trailer">
                                    '.$text.'
                                    </span>
                                 </div>
                                 <p class="title">'.$mov->title.'</p>
                              </a>
                              <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                              <div class="viewsCount" style="color:rgb(235, 12, 12);">'.$mov->year.'</div>
                              
                              <div style="float: left;">
                                 <ul class="list-inline rating"  title="Average Rating">
                                 ';

for($count=1; $count<=5; $count++){
              $output.='<li title="star_rating" style="font-size:25px;color:#ffcc00;padding: 0px;">&#9733; 
             
              </li>';
        }
             
        $output.='</ul>
                              </div>
                           </div>';
        }
        echo $output;
    }
    public function filter_default(Request $request){
        $data = $request->all();
        $moview =Movie::where('topview',0)->orderBy('ngaycapnhap','desc')->take(20)->get();
        $output ='';
        foreach($moview as $key => $mov){
            if($mov->resolution==0){
                $text ='HD';
            }elseif($mov->resolution==1){
                $text ='SD';
            }elseif($mov->resolution==2){
                $text ='HDCAM';
            }elseif($mov->resolution==3){
                $text ='Cam';  
            }elseif($mov->resolution==4){
                $text ='FullHD';
            }elseif($mov->resolution==5){
                $text ='Trailer';
            }
            $output.='<div class="item">
                              <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                                 <div class="item-link">
                                    <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                                    <span class="is_trailer">
                                    '.$text.'
                                    </span>
                                 </div>
                                 <p class="title">'.$mov->title.'</p>
                              </a>
                              <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                              <div class="viewsCount" style="color:rgb(235, 12, 12);">'.$mov->year.'</div>
                              <div style="float: left;">
                                  <ul class="list-inline rating"  title="Average Rating">
                                 ';

for($count=1; $count<=5; $count++){
              $output.='<li title="star_rating" style="font-size:25px;color:#ffcc00;padding: 0px;">&#9733; 
             
              </li>';
        }
             
        $output.='</ul>
                              </div>
                           </div>';
        }
        echo $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =Category::pluck('title','id');
        $country =Country::pluck('title','id');
        $list_genre = Genre::all();
        $genre =Genre::pluck('title','id');
        
        return view('admincp.movie.form',compact('category','country','genre','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->sotap = $data['sotap'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->phude = $data['phude'];
        $movie->resolution = $data['resolution'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->country_id = $data['country_id'];
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhap = Carbon::now('Asia/Ho_Chi_Minh');
        foreach($data['genre'] as $key =>$gen){
        $movie ->genre_id = $gen[0];
    }
        
        
        //thêm hình ảnh
        $get_image = $request->file('image');
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        // thêm nhiều thể loại phim
        $movie->movie_genre()->attach($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =Category::pluck('title','id');
        $genre =Genre::pluck('title','id');
        $country =Country::pluck('title','id');
        $list_genre = Genre::all();
        $movie = Movie::find($id);
        $movie_genre= $movie->movie_genre;
        return view('admincp.movie.form',compact('category','genre','country','movie','list_genre','movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // return response()->json($data['genre']);
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->sotap = $data['sotap'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->phude = $data['phude'];
        $movie->resolution = $data['resolution'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->country_id = $data['country_id'];
        $movie->ngaycapnhap = Carbon::now('Asia/Ho_Chi_Minh');
        //thêm hình ảnh
        $get_image = $request->file('image');
        
        if($get_image){
            if(file_exists('uploads/movie/'.$movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }else{
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie/',$new_image);
                $movie->image = $new_image;
            }
        }
        foreach($data['genre'] as $key =>$gen){
            $movie ->genre_id = $gen[0];
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        //xoa anh
        if(file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        //xoa thể loai
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
         //xoa tập phim
         Episode::whereIn('movie_id',[$movie->id])->delete();
        $movie->delete();
       
        
        return redirect()->back();
        
    }
}
