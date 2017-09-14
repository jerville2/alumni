<?php

namespace App\Providers;

use App\Alumni;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Item;
use App\College;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_valid_or', function($attribute, $value, $parameters, $validator) {
            $result = DB::table('official_receipts')->where('orcode',$value)->count();
            if ($result > 0){
                return true;
            }
            return false;
        });

        Validator::extend('is_old_password', function($attribute, $value, $parameters, $validator) {
            $user = User::find(Auth::user()->id);
            if (Hash::check($value, $user->password)) {
                return true;
            }
            return false;
        });

        //category table
        view()->composer('category.category-table',function ($view){
            $view->with('categories',\App\Category::all());
        });
        //migration
        view()->composer('gen.migrate-ci',function ($view){

            $view->with('cat',\App\Category::all());
        });
        //reports form
        view()->composer('reports.report-form',function ($view){
            $years=array();
            for ($i=Carbon::now()->format('Y');$i>=1978;$i--){
                $years[$i]=$i;
            }

            $items=Item::all();
            array_reverse($years);
            $view->with('college',College::take(11)->get());
            $view->with('years1',$years);
            $view->with('items',$items);

            $yg=Alumni::where('year_graduated','!=',0)->distinct()->orderBy('year_graduated')->get(['year_graduated']);
            $view->with('yg',$yg);
            $view->with('defYear',Carbon::now()->format('Y')-5);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
