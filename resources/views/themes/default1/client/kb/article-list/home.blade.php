@extends('themes.default1.client.layout.client')

@section('title')
    Knowledge Base -
@stop

@section('knowledgebase')
    class = "active"
@stop
@section('content')

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa  fa-check-circle"></i>
    <b>Success!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{Session::get('success')}}
</div>
@endif
<!-- failure message -->
@if(Session::has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>Alert!</b> Failed.
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{Session::get('fails')}}
</div>
@endif
@section('breadcrumb')
<div class="site-hero clearfix">
    
        <ol class="breadcrumb breadcrumb-custom">
            <li>{!! Lang::get('lang.you_are_here') !!}: </li>
            <li>{!! Lang::get('lang.knowledge_base') !!}</li>
        </ol>
    
</div>
@stop
<div id="content" class="site-content col-md-9">
    <div class="row">
        <?php
        //$categories = App\Model\kb\Category::all();
        $categories = App\Model\kb\Category::where('status', 1)
                ->orderBy('parent', 'asc')->orderBy('name', 'asc')
                ->get();
        ?>
        @foreach($categories as $category)
        {{-- get the article_id where category_id == current category --}}
        <?php
        $all = App\Model\kb\Relationship::all();
        /* from whole attribute pick the article_id */
        $page = App\Model\kb\Relationship::where('category_id', '=',$category->id)->paginate('3');
        /* from whole attribute pick the article_id */
        $article_id = $page->lists('article_id');
        $count = count($article_id);
        ?>
        <div class="col-md-6">
            <section class="box-categories">
                <h1 class="section-title h4 clearfix">
                    <i class="fa fa-folder-open-o fa-fw text-muted"></i>
                    <small class="pull-right"><i class="fa fa-hdd-o fa-fw"></i></small>
                    {{$category->name}}
                </h1>
                <ul class="fa-ul">
                    <?php foreach ($article_id as $id) {
                    
                        $article = App\Model\kb\Article::where('id', '=', $id)->where('status', '=','1')->where('type', '=','1')->limit(3)->get();
                        ?>
                        @foreach($article as $arti)
                        <li>
                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                            <h3 class="h5"><a href="{{url('show/'.$arti->slug)}}">{{$arti->name}}</a></h3>
                        </li>
                        @endforeach
<?php } ?>
                </ul>
                <p class="more-link text-center"><a href="{{url('category-list/'.$category->slug)}}" class="btn btn-custom btn-xs">{!! Lang::get('lang.view_all') !!}</a></p>
            </section>
        </div>
        @endforeach
        
    </div>
</div>
@stop

@section('category')
<h2 class="section-title h4 clearfix">{!! Lang::get('lang.categories') !!}<small class="pull-right"><i class="fa fa-hdd-o fa-fw"></i></small></h2>
<ul class="nav nav-pills nav-stacked nav-categories">
    @foreach($categorys as $category)
<?php
$num = \App\Model\kb\Relationship::where('category_id','=', $category->id)->get();
$article_id = $num->lists('article_id');
$numcount = count($article_id);
?>
    @if($numcount > 0)
    <li><a href="{{url('category-list/'.$category->slug)}}"><span class="badge pull-right">{{$numcount}}</span>{{$category->name}}</a></li>
    @endif
    @endforeach
</ul>
@stop
