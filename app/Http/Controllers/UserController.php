<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class UserController extends Controller
{
    public function register(Request $req){
    	// return true;
    	$user = new User();
    	$user->nom = $req->nom;
        $user->prenom = $req->prenom;
        $user->email = $req->email;
        $user->civilite = $req->civilite;
        $user->password = bcrypt($req->password);
        // $user->photo = $req->photo;
        $user->ville = $req->ville;
        $user->adresse = $req->adresse;

        if($req->hasFile('photo')){
        	$destination_path = 'public/images';
        	$image = $req->file('photo');
        	$image_name = $image->getClientOriginalName();
        	$path = $req->file('photo')->storeAs($destination_path,$image_name);
			$user->photo = $image_name;
        }

        $user->save();

        // return $user;
        return response()->json(['resultat' => $user->id], 201); 
    }

    public function login(Request $req){
		if( Auth::attempt(['email'=>$req->email,'password'=>$req->password]) )
			return response()->json(['userID' => Auth::id() ], 201); 

		else return response()->json(['user' => 'no user found'], 401); 
    }

    public function updateProfile(Request $req){
    	$user = User::find($req->id);
    	$user->nom = $req->nom;
        $user->prenom = $req->prenom;       
        $user->civilite = $req->civilite;     
        // $user->photo = $req->photo;
        $user->ville = $req->ville;
        $user->adresse = $req->adresse;

        if($req->hasFile('photo')){
        	$destination_path = 'public/images';
        	$image = $req->file('photo');
        	$image_name = $image->getClientOriginalName();
        	$path = $req->file('photo')->storeAs($destination_path,$image_name);
			$user->photo = $image_name;
        }
        
        $user->save();
        return response()->json(['message' => 'succes'], 201); 
    }

    public function getUserInfos(Request $req){
    	$user = User::find($req->id);
    	if($user)
    		return response()->json(['user' => $user], 201);
    	else  
    		return response()->json(['message' => 'no user found'], 401); 
    }

    public function test(){
    	return 'Hi Man';
    }
}
