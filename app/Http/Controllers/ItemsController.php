<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Item;
use \App\CategoryMaster;
use \App\User;

  class ItemsController extends Controller
  {
        
        public function index()
    {

        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $items = $user->items()->orderBy('created_at', 'desc')->paginate(10);
            
        $data = [
                'user' => $user,
                'items' => $items,
            ];
            $data += $this->counts();

            return view('items.show',$data);
        }
    }
    
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 最小縦横120px 最大縦横400px
                'dimensions:min_width=200,min_height=250,max_width=350,max_height=400',
            ]
        ]);


        if ($request->file('file')->isValid([])) {
            $filename = $request->file->store('public/image');

            $user = User::find(auth()->id());
            $user->image_url = basename($filename);
            $user->save();

            return redirect('/')->with('success', '保存しました。');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
    }
    
    
        
        public function create()
    {
        $item = new Item;
        
        return view('items.create', [
            'item' => $item,
        ]);
    }
    
    public function store(Request $request)
    {
       
        $this->validate($request, [
            
            'file' => 'required',
            'category_masters' => 'required',
            'name' => 'required',
            'content' => 'required|max:300',
            'price' => 'required|max:99999999999',
        ]);
        
        $filename = $request->file->store('public/image');

        $request->user()->items()->create([
            'image_url' => basename($filename),
            'category_id' => $request->category_masters,
            'name' => $request->name,
            'content' => $request->content,
            'price' => $request->price,
        ]);

       return redirect('/');
        
    }

    public function show($id)
        {
            // $user = User::find($id);
            $item = Item::find($id);
            $items = \DB::table('items')->join('category_masters','items.category_id', '=', 'category_masters.id')->select('category_masters.*')->get();
            
            
            if ($item->user_id){
                return view('items.show', [
                    // 'user' => $user,
                    'item' => $item,
                ]);
            }else {
                return redirect("/");
            }
        }
        
    public function edit($id)
        {
            $item = \App\Item::find($id);
            if (\Auth::user()->id === $item->user_id) {
            return view('items.edit', [
                'item' => $item,
            ]);
        }else {
            return redirect("/");
            }
        }
        
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'file' => 'required',
            'category_masters' => 'required',
            'name' => 'required',
            'content' => 'required|max:300',
            'price' => 'required|max:99999999999',
        ]);

        
        $filename = $request->file->store('public/image');

        $item = Item::find($id);
        $item -> image_url = basename($filename);
        $item -> category_id = $request->category_masters;
        $item -> name = $request->name;
        $item -> content = $request->content;
        $item -> price = $request->price;
        $item ->save();

        return redirect('/');
    }
    
    public function destroy($id)
    {
        $item = \App\Item::find($id);

        if (\Auth::user()->id === $item->user_id) {
            $item->delete();
        }

        return redirect("/");
    }
    

 }