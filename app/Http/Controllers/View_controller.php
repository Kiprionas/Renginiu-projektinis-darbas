<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class View_controller extends Controller
{

    public function show_main($city = NULL){

        $cities = array("Visi", "Kaunas", "Vilnius", "Klaipeda", "Siauliai", "Panevezys", "Alytus", "Birstonas", "Palanga", "Druskininkai");
        $categories = array("Vaikams", "Mokymai", "Ekskursijos", "Sportas", "Seminarai", "Iniciatyvos", "Spektakliai", "Parodos", "Koncertai", "Festivaliai", "Vakareliai");
        
        if($city != NULL){
            $posts = DB::table('users_events_posts')->where('city', $city)->get();
        }else{
            $posts = DB::table('users_events_posts')->get();
        }


        return view('main')->with('cities', $cities)->with('categories', $categories)->with('posts', $posts);
    }

    public function show_login(){
        return view('login');
    }

    public function show_register(){
        return view('register');
    }

    public function show_create(){

        $cities = array("Kaunas", "Vilnius", "Klaipeda", "Siauliai", "Panevezys", "Alytus", "Birstonas", "Palanga", "Druskininkai");

        return view('create')->with('cities', $cities);
    }

    public function show_profile(){

        $user_info = Auth::user();
        
        return view('user_profile')->with('user_info', $user_info);
    }

    public function show_test(){
        return view('test');
    }

    public function show_private($item = NULL){

        if(Gate::allows('admin-only', [Auth::user()])){
            if($item == 'users' || $item == NULL){
                $data = DB::table('users')->get();
                $what = 'users';
            }elseif($item == 'posts'){
                $data = DB::table('users_events_posts')->get();
                $what = 'posts';
            }else{
                $date = [];
                $what = NULL;
            }


            return view('private')->with('data', $data)->with('what', $what);
        }else{
            abort(403);
        }
        
    }

    public function show_email_verify(){
        if(Gate::allows('non-verified-users', Auth::user())){
            return view('email_verify');
        }else{
            return redirect('main');
        }
    }

    public function show_profile_update(){
        $user_info = Auth::user();

        return view('user_profile_update')->with('user_info', $user_info);
    }

    public function show_post($event_id){
        $post_info = DB::table("users_events_posts")->where("id", $event_id)->get();
        $allow_update = Gate::allows('allow-update', $post_info);
        $bought_events = explode(", ", Auth::user()->events_bought);

        return view("post")->with(['post_info' => $post_info, 'allow_update' => $allow_update, 'bought_events' => $bought_events]);
    }

    public function show_update_post($event_id){
        $post_info = DB::table("users_events_posts")->where("id", $event_id)->get();
        $start = explode(':', $post_info[0]->start_time);
        $end = explode(':', $post_info[0]->end_time);
        if(Gate::allows('allow-update', $post_info)){
            return view("update_post")->with(['post_info' => $post_info, "start" => $start, "end" => $end]);
        }
        abort(403);

    
    }

    public function show_forgot_password(){
        return view('forgot_password');
    }

    public function show_reset_password($token){
        return view('reset_password')->with(['token' => $token]);
    }
    
}
