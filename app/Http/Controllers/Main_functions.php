<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\UserEventsPosts;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Gate;

class Main_functions extends Controller
{
    
    public function login_method(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $remember = request('remember');

        $credentials = $request->only('email', 'password');

        if($remember == True){
            if(Auth::attempt($credentials, $remember)){
                $request->session()->regenerate('/main');
    
                return redirect('/main');
            }

            return back()->withErrors([
                'error' => 'Not valid email or password try again',
            ]);

        }else{

            if(Auth::attempt($credentials)){
                $request->session()->regenerate('/main');
    
                return redirect('/main');
            }

            return back()->withErrors([
                'error' => 'Not valid email or password try again',
            ]);
        }    

    }

    public function logout_method(){
        Auth::logout();

        return redirect('/main');
    }

    public function register_method(Request $request){

        $register = new Users;

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:Users',
            'password' => 'required'
        ]);

        $register->name = request('name');
        $register->surname = request('surname');
        $register->email = request('email');
        $register->password = request('password');
        $reppassword = request('repPassword');
        $register->picture = request('file');


        if($register->password == $reppassword){
            if($register->picture == NULL){
                $register->picture = 'images/1765-vynu-tuzas.jpg';
            }
            $register->password = Hash::make($register->password);
            $reppassword = '';
            $register->save();
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $request->session()->regenerate();
                $request->user()->SendEmailVerificationNotification();
                return redirect('/main');
            }
        }else{
            return redirect('/register')->with('repPasswordError', 'Neteisingai pakartotas slaptazodis');
        }
    }

    public function create_method(Request $request){

        $request->validate([
            'eventname' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'start_hour' => 'required|numeric|min:0|max:23',
            'start_minute' => 'required|numeric|min:0|max:59',
            'end_hour' => 'required|numeric|min:0|max:23|gte:start_hour',
            'end_minute' => 'required|numeric|min:0|max:59|gte:start_minute',
            'number_of_seats' => 'min:0|max:50000',
            'price' => 'numeric|min:0',
            'city' => 'required',
        ]);

        $start_time = request('start_hour'). ":". request('start_minute');
        $end_time = request('end_hour'). ":". request('end_minute');

        $usersposts = new UserEventsPosts;
        $user = Users::find(Auth::id());

        $usersposts->eventname = request('eventname');
        $usersposts->description = request('description');
        $usersposts->start_day = request('start_date');
        $usersposts->end_day = request('end_date');
        $usersposts->start_time = $start_time;
        $usersposts->end_time = $end_time;
        $usersposts->picture = request('picture');
        $usersposts->price = request('price');
        $usersposts->user_id = Auth::id();
        $usersposts->city = request('city');
        $usersposts->number_of_seats = request('number_of_seats');

        if($usersposts->picture == NULL){
            $usersposts->picture = "../" .'images/1765-vynu-tuzas.jpg';
        }else{
            $usersposts->picture = "../" . $usersposts->picture;
        }
        if($usersposts->price == NULL){
            $usersposts->price = 0;
        }
        if($usersposts->number_of_seats == NULL){
            $usersposts->number_of_seats = 0;
        }

        $usersposts->save();
        $user->events_created .= ', '. strval($usersposts->id);
        $user->save();
        return redirect('/main');

    }

    public function delete_event($id){
        if(Gate::allows('admin-only', Auth::user())){
            DB::table('users_events_posts')->where('id', $id)->delete();
            return redirect()->back();
        }else{
            abort(403);
        }
    }

    public function delete_user($id){
        if(Gate::allows('admin-only', Auth::user())){
            DB::table('users_events_posts')->where('id', $id)->delete();
            return redirect()->back();
        }else{
            abort(403);
        }
    }

    public function email_verify(EmailVerificationRequest $request){
        if(Gate::allows('non-verified-users', Auth::user())){
            $request->fulfill();

            return redirect('/main');
        }
    }

    public function send_verification(Request $request){
        if(Gate::allows('non-verified-users', Auth::user())){
            $request->user()->SendEmailVerificationNotification();

            return redirect('/main');
        }
    }

    public function update_post_method($event_id, Request $request){

        $request->validate([
            'eventname' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'start_hour' => 'required|numeric|min:0|max:23',
            'start_minute' => 'required|numeric|min:0|max:59',
            'end_hour' => 'required|numeric|min:0|max:23|gte:start_hour',
            'end_minute' => 'required|numeric|min:0|max:59|gte:start_minute',
            'price' => 'numeric',
        ]);

        $start_time = request('start_hour'). ":". request('start_minute');
        $end_time = request('end_hour'). ":". request('end_minute');
        $eventname = request('eventname');
        $description = request('description');
        $start_day = request('start_date');
        $end_day = request('end_date');
        $picture = request('picture');
        $price = request('price');

        if($picture == NULL){
            $picture = "../". 'images/1765-vynu-tuzas.jpg';
        }else{
            $picture = "../". $picture;
        }
        if($price == NULL){
            $price = 0;
        }

        DB::table("users_events_posts")->where("id", $event_id)->update(['eventname' => $eventname, 'description' => $description, 'start_day' => $start_day, 'picture' => $picture,
                                                                        'end_day' => $end_day, 'start_time' => $start_time, 'end_time' => $end_time, 'price' => $price]);
        return redirect('/main');

    }

    public function buy_post_method($event_id){
        $post = DB::table('users_events_posts')->where('id', $event_id)->get();
        $user_posts = explode(", ", Auth::user()->events_bought);
        if($post[0]->number_of_seats == 0 && (!in_array($event_id, $user_posts))){
            $user = Users::find(Auth::id());
            $user->events_bought .= ", ". $event_id;
            $user->save();

            return redirect('/main');
        }elseif($post[0]->number_of_seats > 0 && (!in_array($event_id, $user_posts))){
            $user = Users::find(Auth::id());
            $user->events_bought .= ", ". $event_id;
            $user->save();
            DB::table('users_events_posts')->where('id', $event_id)->decrement('number_of_seats');

            return redirect('/main');
        }else{
            return redirect()->back()->withErrors('error', 'Negalimas veiksmas');
        }
    }

    public function send_forgot_password_method(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset_password_method(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'rep_password' => 'required|min:8|same:password',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

}
