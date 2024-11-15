<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategoriy;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function articles(){
        $articles=Article::latest()->paginate(12);
        $categories=ArticleCategoriy::all();
        return view('home.blogs',compact('articles','categories'));
    }
    public function articles_category($category){
        $articles=Article::where('category_id',$category)->latest()->paginate(12);
        $categories=ArticleCategoriy::all();
        return view('home.blogs',compact('articles','categories'));
    }
    public function article($alias){
        $article=Article::where('alias',$alias)->first();
        $category_id=$article->category_id;
        $articles=Article::where('id','!=',$article->id)->where('category_id',$category_id)->latest()->take(4)->get();
        $categories=ArticleCategoriy::all();
          $random_blog = Article::inRandomOrder()->where('id', '!=', $article->id)->first();
        $article->update([
            'hit'=> $article->hit + 1
            ]);
        return view('home.blog',compact('article','articles','categories','random_blog'));
    }
}
