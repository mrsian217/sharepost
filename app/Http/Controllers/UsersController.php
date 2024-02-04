<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;                        // 追加
use App\Models\User;  

class UsersController extends Controller
{
    public function index()                                 // 追加       
    {                                                       // 追加
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10); // 追加

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [                        // 追加
            'users' => $users,                              // 追加
        ]);                                                 // 追加
    }                                                       // 追加
    
    public function show($id)                               // 追加
    { 
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $shareposts = $user->shareposts()->orderBy('created_at', 'desc')->paginate(6);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'shareposts' => $shareposts,
        ]);
    }      
}
