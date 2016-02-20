@section('sidebar')
    <li class="header">Veel Gestelde Vragen</li>
    <li class="treeview @yield('category')">
        <a href="#">
            <i class="fa fa-list-ul"></i> <span>{{Lang::get('lang.category')}}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li @yield('add-category')><a href="{{url('admin/category/create')}}"><i
                            class="fa fa-circle-o"></i> {{Lang::get('lang.addcategory')}}</a></li>
            <li @yield('all-category')><a href="{{url('admin/category')}}"><i
                            class="fa fa-circle-o"></i> {{Lang::get('lang.allcategory')}}</a></li>
        </ul>
    </li>
    <li class="treeview @yield('article')">
        <a href="#">
            <i class="fa fa-edit"></i> <span>{{Lang::get('lang.article')}}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li @yield('add-article')><a href="{{url('admin/article/create')}}"><i
                            class="fa fa-circle-o"></i> {{Lang::get('lang.addarticle')}}</a></li>
            <li @yield('all-article')><a href="{{url('admin/article')}}"><i
                            class="fa fa-circle-o"></i> {{Lang::get('lang.allarticle')}}</a></li>
        </ul>
    </li>
    <li class="treeview @yield('pages')">
        <a href="#">
            <i class="fa fa-file-text"></i> <span>{{Lang::get('lang.pages')}}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li @yield('add-pages')><a href="{{url('admin/page/create')}}"><i
                            class="fa fa-circle-o"></i> {{Lang::get('lang.addpages')}}</a></li>
            <li @yield('all-pages')><a href="{{url('admin/page')}}"><i
                            class="fa fa-circle-o"></i> {{Lang::get('lang.allpages')}}</a></li>
        </ul>
    </li>
@stop