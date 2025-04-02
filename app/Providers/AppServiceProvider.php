<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Info;
use Illuminate\Support\Facades\View;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhap','desc')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('ngaycapnhap','desc')->take(10)->get();
        $category = Category::orderBy('id', 'desc')->where('status',1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        //total admin
        $category_total = Category::all()->count();
        $genre_total = Genre::all()->count();
        $country_total = Country::all()->count();
        $movie_total = Movie::all()->count();
        
        $info = Info::find(1);
        view::share('info',$info);
        view::share('phimhot_sidebar',$phimhot_sidebar);
        view::share('phimhot_trailer',$phimhot_trailer);
        view::share('category_home',$category);
        view::share('genre_home',$genre);
        view::share('country_home',$country);
        view::share('category_total',$category_total);
        view::share('genre_total',$genre_total);
        view::share('country_total',$country_total);
        view::share('movie_total',$movie_total);
    }
}
