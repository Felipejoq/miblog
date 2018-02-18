<ul class="sidebar-menu" data-widget="tree">
    <li class="header">NAVEGACIÓN</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ setActiveRoute('dashboard') }}">
        <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span>Inicio</span></a>
    </li>
    <li class="treeview {{setActiveRoute('admin.posts.index')}}">
        <a href="#"><i class="fa fa-bars"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setActiveRoute('admin.posts.index') }}"><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i>Todos los post</a></li>
            <li class="">
                @if(request()->is('admin/posts/*'))
                    <a href="{{ route('admin.posts.index', '#create') }}"><i class="fa fa-edit"></i> Crear un post</a>
                @else
                    <a href="#"
                       data-toggle="modal"
                       data-target="#exampleModal">
                        <i class="fa fa-edit"></i> Crear un post
                    </a>
                @endif
            </li>
        </ul>
    </li>

    <li class="treeview {{setActiveRoute(['admin.users.index', 'admin.users.create'])}}">
        <a href="#"><i class="fa fa-users "></i> <span>Usuarios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setActiveRoute('admin.users.index') }}"><a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Todos los usuarios</a></li>
            <li class="{{ setActiveRoute('admin.users.create') }}">
                <a href="{{ route('admin.users.create') }}"><i class="fa fa-edit"></i> Crear un usuario</a>
            </li>
        </ul>
    </li>
</ul>