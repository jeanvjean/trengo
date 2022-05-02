<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Likes;
use App\Models\Ratings;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->query('categories');
        $from_date = $request->query('from_date');
        $to_date = $request->query('to_date');
        $is_filter = false;
        $is_filter = $categories || $from_date || $to_date ? true : false;
        $search = $request->query('search');
        // $qPost = DB::select('SELECT p.id as id, c.name as category, p.content as body, p.title as title, p.created_at as created_on from posts p left join categories c on p.category_id = c.id');
        if($is_filter) {
            $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id as id', 
            'categories.name as category', 
            'posts.content as body', 
            'posts.title as title', 
            'posts.created_at as created_on')
            ->where('category_id', '=', $categories)
            ->orWhere('posts.created_at', '>=', date($from_date))
            ->orWhere('posts.created_at', '<=', date($to_date))
            ->orWhere('title', 'ilike', '%' . $search . '%')
            ->orWhere('content', 'ilike', '%' . $search . '%')
            ->orderBy('views', 'desc')
            ->orderBy('average_rating', 'desc')
            ->get();
        }else {
            $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id as id', 
            'categories.name as category', 
            'posts.content as body', 
            'posts.title as title', 
            'posts.created_at as created_on')
            ->where('title', 'ilike', '%' . $search . '%')
            ->orWhere('content', 'ilike', '%' . $search . '%')
            ->orderBy('views', 'desc')
            ->orderBy('average_rating', 'desc')
            ->get();
        }
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) 
    {
        //
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
            'title'=>'required',
            'content'=>'required',
            'category_id'=>'required'
        ]);
        $ip = \Request::ip();
        $posts = Posts::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'category_id'=> $request->category_id,
        ]);
        return $posts;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        [$post] = DB::table('posts')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->where('posts.id', '=', $id)
        ->select(
            'posts.title as title', 
            'posts.content as body', 
            'categories.name as category', 
            'posts.created_at as created_on', 
            'posts.id as id', 
            'posts.views as views')
        ->get();
        $views = $post->views += 1;
        DB::table('posts')->where('id', '=', $post->id)->update([
            'views' => $views
        ]);
        return $post;
    }


    public function like($id, Request $request) {

        $post = Posts::find($id);
        $ip = \Request::ip();
        if($request->query('type') === 'like') {
            $findLiked = DB::select('SELECT * FROM likes where :ip = ip_address AND post_id = :post_id', ['ip'=>$ip, 'post_id'=> $id]);
            if(count($findLiked) > 0) {
                return $post;
            }
            $liked = Likes::create([
                'post_id'=>$id,
                'ip_address'=>$ip,
            ]);
            return $post;
        }elseif($request->query('type') === 'rate'){
            $findRated = DB::select('SELECT * FROM ratings where :ip = ip_address AND post_id = :post_id', ['ip'=>$ip, 'post_id'=> $id]);
            if(count($findRated) > 0) {
                return $post;
            }
            $rate = Ratings::create([
                'post_id'=>$id,
                'ip_address'=>$ip,
                'rate'=>$request->rate
            ]);
            [ $rating ] = DB::select('select avg(rate::INTEGER) AS average_rate from ratings where post_id = :id AND ip_address = :ip', ['id'=>$id, 'ip'=>$ip]);
            $post->average_rating = $rating->average_rate;
            $post->save();
            return $post;
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
