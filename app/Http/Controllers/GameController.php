<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Game;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;

use View;

class GameController extends Controller
{
    public function index(){
        $games=Game::where('most_viwed',0)->orderBy('created_at')->get();
        $mostviewd=Game::where('most_viwed',1)->get();

        return view('games.index',['games'=>$games,'mostviewd'=>$mostviewd]);
    }

    public function show($id) {
        $game = Game::findOrFail($id);
        $comments = $game->comments; // Assuming you have a relationship set up in the Game model

        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

    
        return view('games.show', [
            'game' => $game,
            'comments' => $comments,
            'cartCount'=>$cartCount
        ]);
    }

    public function create(){
        return View('games.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required | string',
            'desc'=>'required | string',
            'price' => 'required|numeric',    
        'img'=> 'required | image | mimes:jpg,png,webp,avif,jpeg',
        
        ]);
        $name=$request->name;
        $desc=$request->desc;
        $price=$request->price;
        $img=$request->file('img');
        $exe=$img->getClientOriginalExtension();
        $imgname='game - '. uniqid() . $exe;
        $img->move(public_path('uploads\games'),$imgname);

        Game::create([
            'name'=> $name,
            'desc'=>$desc,
            'price'=>$price,
            'img'=>$imgname

        ]);

        return redirect(route('games.index'));

    }

    public function update($id){
        $game=Game::findOrFail($id);
        return view('games.update',['game'=>$game]);

    }

    public function edit(Request $request, $id){
        $request->validate([
            'name'=>'required | string',
            'price' => 'required|numeric',    
            'desc'=>'required | string',
        ]);
       Game::findOrFail($id)->update([
            'name'=> $request->name,
            'price'=>$request->price,
            'desc'=>$request->desc,
        ]);

        return redirect(route('games.index'));
    }

    public function delete($id){
        Game::findOrFail($id)->delete();

        return redirect(route('games.index'));

    }

    // public function indexcomment($id){
    //     $game = Game::findOrFail($id);
    //     // $comments = $game->comments; 
    //     return view('games.show', ['game' => $game]);
    // }
    
    public function storecomment(Request $request, $id){
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        $game = Game::findOrFail($id);
    
        Comment::create([
            'content' => $request->comment,
            'user_id' => Auth::id(), 
            'game_id' => $game->id, 

        ]);
    
        return redirect()->route('games.show', $game->id);
    }

    public function deletecomment($id){
        $comment = Comment::findOrFail($id);
    
        $gameId = $comment->game_id; 
    
        $comment->delete();
    
        return redirect()->route('games.show', $gameId);
    }
    
    public function add(Request $request ,$id){
        $game=Game::findOrFail($id);

        

        if(!$request->session()->has('cart')){
            $request->session()->put('cart',[]);
        }

        $cart=$request->session()->get('cart');

        if(isset($cart[$id])){
            $cart[$id]['quantity']+=1;
        }else{
            $cart[$id]=[
                'name'=> $game->name,
                'price' => $game->price,
                'quantity'=>1,
                'img'=> $game->img,
            ];
        }

        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Game added to cart!');

    }

    public function cart(){
        return view('cart.view');
    }

    public function Remove($id){
        $cart=session()->get('cart');
        if($cart[$id]['quantity']>1){
            $cart[$id]['quantity']-=1;
        }elseif(isset($cart[$id])){
            unset($cart[$id]);
        }
        
        session()->put('cart', $cart);
        return redirect()->route('cart.view')->with('success', 'Game removed from cart!');

    }


    public function buy(Request $request){
        $request->session()->flush();

        Auth::logout();
        return redirect(route('auth.login'));

    }
    

    
}
