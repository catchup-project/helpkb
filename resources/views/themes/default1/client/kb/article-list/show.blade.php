@extends('themes.default1.client.layout.client')
@section('breadcrumb')

    <?php
    //dd($arti);
    $all = App\Model\kb\Relationship::where('article_id', '=', $arti->id)->get();
    /* from whole attribute pick the article_id */
    $category_id = $all->lists('category_id');
    ?>

    <div class="site-hero clearfix">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="text">{!! Lang::get('lang.you_are_here') !!}:</li>
            <?php $category = App\Model\kb\Category::where('id', $category_id)->first(); ?>
            <li><a href="{{url('/')}}">{!! Lang::get('lang.home') !!}</a></li>
            <li><a href="{{url('/knowledgebase')}}">{!! Lang::get('lang.knowledge_base') !!}</a></li>
            <li><a href="{{url('category-list/'.$category->slug)}}">{{$category->name}}</a></li>
            <li class="active">{{$arti->name}}</li>
        </ol>
    </div>
@stop
@section('content')
    <div id="content" class="site-content col-md-9">
        <article class="hentry">
            <header class="entry-header">
                <h1 class="entry-title">{{$arti->name}}</h1>

                <div class="entry-meta text-muted">
                    <span class="date"><i class="fa fa-film fa-fw"></i> <time
                                datetime="2013-09-19T20:01:58+00:00">{{$arti->created_at->format('l, d-m-Y')}}</time></span>
                    <span class="category"><i class="fa fa-folder-open-o fa-fw"></i> <a href="#">{{$category->name}}</a></span>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-content clearfix">

                <p>{!!$arti->description!!}</p>

            </div><!-- .entry-content -->

        </article><!-- .hentry -->
    </div>
@stop

@section('title')
    @if(isset($category->name))
        {!! $category->name !!} -
    @endif
@stop

@section('category')
    <h2 class="section-title h4 clearfix">{!! Lang::get('lang.categories') !!}
        <small class="pull-right"><i class="fa fa-hdd-o fa-fw"></i></small>
    </h2>
    <ul class="nav nav-pills nav-stacked nav-categories">

        <?php $categorys = App\Model\kb\Category::all(); ?>
        @foreach($categorys as $category)
            <?php
            $num = \App\Model\kb\Relationship::where('category_id', '=', $category->id)->get();
            $article_id = $num->lists('article_id');
            $numcount = count($article_id);
            ?>
            <li><a href="{{url('category-list/'.$category->slug)}}"><span
                            class="badge pull-right">{{$numcount}}</span>{{$category->name}}</a></li>
        @endforeach
    </ul>
@stop