<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Post;
use App\views\composers\NavigationComposer;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        /*view()->composer('layout.sidebar',function($view){
           $categories=Category::with(['posts'=>function($query){
            $query->published();
        }])->orderBy('title','asc')->get();
           return $view->with('categories',$categories);
        });
        view()->composer('layout.sidebar',function($view){
            $popularPosts=Post::published()->popular()->take(3)->get();
        return $view->with('popularPosts',$popularPosts);
        });*/
        view()->composer('layout.sidebar',NavigationComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
