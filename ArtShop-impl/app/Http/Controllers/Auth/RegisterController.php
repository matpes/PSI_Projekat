<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Kupac;
use App\Providers\RouteServiceProvider;
use App\Slikar;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\exception_for;

class RegisterController extends Controller
{
    /*
    | Author: Samardžija Sanja 17/0372
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |   Registracija, validacija i kreiranje novih korisnika
    |
    */

    use RegistersUsers;


    /*
     *  Author: Samardžija Sanja 17/0372
     *      Konstruktor kontrolera koji zabranjuje da bilo kojoj
     *      funkciji ovog kontrolera pristupi neko ko nema status gosta.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /*
     *  Author: Samardžija Sanja 17/0372
     *      Prikazuje stranicu za registraciju
     * @return view
     */
    public function index(){
        return view('auth.register');
    }


    /*
     *  Author: Samardžija Sanja 17/0372
     *      Registruje korisnika ako je uneo validne podatke i preusmerava ga na login stranicu
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $rules = [
            'username' => 'unique:users|max:20',
            'mail' => 'email|unique:users|max:40',
            'password' => 'min:6|alpha_dash',
            'password_confirm' => 'required_with:password|same:password',
        ];
        $messages = [
            'username.required'=> 'Ovo polje je obavezno',
            'mail.required'=>' Ovo polje je obavezno',
            'password.required' => 'Ovo polje je obavezno',
            'password_confirm.required_with' => 'Ovo polje je obavezno',
            'username.unique' => 'Korisničko ime već postoji',
            'username.max' => 'Korisničko ime mora da bude manje od :max karaktera',
            'mail.unique' => 'Već postoji korisnik sa datim e-mailom',
            'mail.max'=>'E-mail ne sme biti duži od :max karaktera',
            'mail.email'=>'E-mail nije pravilne forme',
            'password.min' => 'Lozinka ne može biti manja od :min',
            'password.alpha_dash' => 'Lozinka može sadržati samo alpa_dash karaktere',
            'password_confirm.same' => 'Lozinke moraju biti iste',

        ];

        $data = $request->all();
        //dd($data);
        $validate = Validator::make($data, $rules, $messages);
        $validate->validate();
        if($validate->fails()){
            //dd("failed");
            return redirect('register')
                ->withErrors($validate->errors())
                ->withInput();
        }else{
            //dd('not failed');
        }

        if ($request->password != $request->password_confirm) {
            //dd('failed_2');
            return redirect('register')
                ->withErrors(['password_confirm' => $request->password . "Lozinka koju ste uneli se ne poklapa sa potvrdom iste" . $request->password_confirm])
                ->withInput();
        }

        $this->create($data);
        return redirect('login')
            ->with('success',"Uspešno kreiran nalog!");

    }


    /*
     *  Author: Samardžija Sanja 17/0372
     *      Pravi user-a i smesta ga u bazu
     *  @return void
     */
    protected function create(array $data)
    {
        //dd($data);
        $user = new User();
        $user->username = $data['username'];
        $user->mail = $data['mail'];
        $user->password = Hash::make($data['password']);
        if($data['optradio'] == "slikar")
              $user->isSlikar = true;
        else
            $user->isSlikar = false;
        /*
        $file = $data['picture'];
        if ($data->hasFile('picture')) {

            $filename = $data->username . '.jpg';
            $file = $file->storeAs('img\users', $filename);
            $user->picture_path = $filename;
        }*/
        $user->save();

        if($data['optradio'] == "slikar") {
            $slikar = new Slikar;
            $slikar->user_id = $user->id;
            $slikar->save();
        }else {
            $kupac = new Kupac;
            $kupac->user_id = $user->id;
            $kupac->save();
        }
    }
}