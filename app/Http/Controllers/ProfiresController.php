<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profire;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class ProfiresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|max:255'
    ]);

    $userId = Auth::id();

    $newProfire = Profire::create([
        'user_id' => $userId,
        'content' => $request->input('content'),
    ]);

    $user = User::findOrFail($userId);
    return redirect()->route('users.show', ['user' => $user->id]);
}
   
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function edit($id)
    {
        $profire = Profire::findOrFail($id);

    // 編集ビューを表示
    $data = [
        'profire' => $profire,
        'user' => Auth::user(),
    ];

    return view('profires.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profire = Profire::findOrFail($id);

        $request->validate([
            'content' => 'required|max:255',
        ]);

        // プロファイルを更新
        $profire->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('users.show', ['user' => $profire->user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
