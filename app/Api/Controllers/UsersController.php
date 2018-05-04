<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Relation;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends BaseController
{
    public function searchMembers($city){
      return User::where('city', $city)->where('type',1)->get();
    }

    public function searchGroups($city){
      return User::where('city', $city)->where('type',2)->get();
    }

    public function fetchProfile(Request $request){
      $id=JWTAuth::parseToken()->authenticate()->id;
      return User::where('id',$id)->get();
    }

    public function editProfile(Request $request){
      $id=JWTAuth::parseToken()->authenticate()->id;
      $user=User::where('id',$id)->get()[0];
      $user->profile=$request->profile;
      $user->name=$request->name;
      $user->city=$request->city;
      $user->save();
    }
}