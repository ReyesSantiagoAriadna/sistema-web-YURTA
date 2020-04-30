<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }*/
    /*public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            //'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
    }*/




    public function login(Request $request){
        $request->validate([
            'telefono'       => 'required|string',
            'password'    => 'required|string',
            //'remember_me' => 'boolean',
        ]);


        $credentials = request(['telefono', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }


    public function avatar(Request $request){
        $filename = User::select('filename') ->where('id',"=",$request->id)->get();
        return response()
            ->download(storage_path('app/public/'.$filename[0]['filename']),'avatar');
    }


    public function  saveAvatar(Request  $request){

        $user = User::find($request->id);


       /* if(!$request->hasFile('fileName')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowedfileExtension=['pdf','jpg','png'];
        $file = $request->file('fileName');
        $errors = [];



        $extension = $file->getClientOriginalExtension();

        $check = in_array($extension,$allowedfileExtension);

        if($check) {
            foreach($request->fileName as $mediaFiles) {
                $media = new Media();
                $media_ext = $mediaFiles->getClientOriginalName();
                $media_no_ext = pathinfo($media_ext, PATHINFO_FILENAME);
                $mFiles = $media_no_ext . '-' . uniqid() . '.' . $extension;
                $mediaFiles->move(public_path().'/images/', $mFiles);
                $media->fileName = $mFiles;
                $media->clientId = $request->clientId;
                $media->uploadedBy = Auth::user()->id;
                $media->save();
            }
        } else {
            return response()->json(['invalid_file_format'], 422);
        }

        return response()->json(['file_uploaded'], 200);


            */

        $cover = $request->file('bookcover');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

        $user->mime = $cover->getClientMimeType();
        $user->original_filename = $cover->getClientOriginalName();
        $user->filename = $cover->getFilename().'.'.$extension;

        $user->save();

        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function buscar_usuario(Request $request){

        $request->validate([
            'telefono'       => 'required|string',
        ]);

        $user = User::select('telefono','name','datos')
            ->where('telefono',"=",$request->telefono)
            ->get();

        if (count($user)>0){
            return response()->json([
                'message'=> 'success',
                'telefono' => $user[0]['telefono'],
                'name' => $user[0]['name'],
                'datos' => $user[0]['datos'],
            ]);
        }

        return response()->json([
            'error' => 'no found'
        ]);
    }

    //# telefono -> contraseña
    //nombre,apellido,correo electronico opcional


    public function signup(Request $request){
            $request->validate([
                'telefono'    => 'required|string',
            ]);

            $user = new User([
                'telefono'    => $request->telefono,
            ]);
            $user->save();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse(
                    $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            ]);

    }



    public function changePassword(Request $request){
        $request->validate([
            'telefono'     => 'required|string',
            'password' => 'required|string',
        ]);
        User::where('telefono', $request->telefono)               //add password
            ->update(['password'=>Hash::make($request->password),'datos'=>'1']);
        return response()->json([
            'message'=>'success',
        ]);
    }

    public function addInf(Request $request){
        $request->validate([
            'telefono' => 'required | string',
            'name'     => 'required|string',
            'email'    => 'string|email',
        ]);

        User::where('telefono', $request->telefono)     //add information
            ->update(['name'=>$request->name,'email'=>$request->email]);
        return response()->json([
            'message'=>'success',
        ]);

    }
}
