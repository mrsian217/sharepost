<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;                        // 追加
use App\Models\User;  

use App\Models\Profire;

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

    // 関連するカウントをロードする
    $user->loadRelationshipCounts();

    // ユーザーの投稿一覧を作成日時の降順で取得
    $shareposts = $user->shareposts()->orderBy('created_at', 'desc')->paginate(6);

    // ユーザーのプロフィールを取得
    $profire = $user->profire;

    // ユーザ詳細ビューでそれを表示
    return view('users.show', [
        'user' => $user,
        'shareposts' => $shareposts,
        'profire' => $profire,
    ]);
    }  
    
     public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    public function goods($id)
    {
        $user = User::findOrFail($id);
        $user->loadRelationshipCounts();
        $goods= $user->goods()->paginate(10);
        
        return view('users.goods', [
            'user' => $user,
            'shareposts' => $goods,
        ]);
    }
    
}
