<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Item;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     
     public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
   public function show($id)
    {
        $user = User::find($id);
        $items = $user->feed_items()->orderBy('created_at', 'desc')->paginate(10);
        // feed_micropostsで自分がフォローしているアカウントのタイムラインの表示している。
        // micropostsだけだと自分のしか反映されない
       

        return view('users.show', [
            'user' => $user,
            'items' => $items,
            ]);
    }
}