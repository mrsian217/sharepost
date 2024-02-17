<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sharepost;
use Illuminate\Support\Facades\Auth;

class SharepostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $shareposts = $user->feed_shareposts()->orderBy('created_at', 'desc')->paginate(6);
            $data = [
                'user' => $user,
                'shareposts' => $shareposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
    public function create()
    {
        $sharepost = new Sharepost;
    
        // メッセージ作成ビューを表示
        $data = [
        'sharepost' => $sharepost,
        'user' => Auth::user(),  
    ];
        return view('shareposts.form',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|max:10',
        'comment' => 'required|max:100',
        'img_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
    $sharepost = $request->user()->shareposts()->create([
        'title' => $request->title,
        'comment' => $request->comment,
    ]);

    if ($request->hasFile('img_path')) {
        $img = $request->file('img_path');
        $path = $img->store('img', 'public');
        
        // ここで $sharepost 変数を定義しています
        $sharepost->update(['img_path' => $path]);
    }

    return redirect('dashboard');
    }
        
     public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $sharepost = \App\Models\Sharepost::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $sharepost->user_id) {
            $sharepost->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }

}
