<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DesignPatterns\Creational\Builder\BlogPostManager;
use App\DesignPatterns\Creational\Builder\BlogPostBuilder;

use App\Models\User;

class CreationalPatternsController extends Controller
{
    public function Builder()
    {
        $description = BlogPostManager::getDescription();

        $builder = new BlogPostBuilder();

        $posts[] = $builder->setTitle('from Builder')
                           ->getBlogPost();

        $manager = new BlogPostManager();
        $manager->setBuilder($builder);

        $posts[] = $manager->createCleanPost();
        $posts[] = $manager->createNewPostIt();
        $posts[] = $manager->createNewPostCats();

        /*Eloquent*/
/*
        $f = User::select(['id', 'name', 'email'])
                    ->whereIn('id', [1,2])
                    ->orderBy('id', 'desc')
                    ->get()
        ;
        dd($f);*/

        \Debugbar::info($posts);

        return view('dump', compact('description'));
    }

}
