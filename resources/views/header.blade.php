<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Pentagon</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{url('orders')}}">Orders</a></li>
            <li><a href="{{url('products')}}">Products</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li style="padding-top: 10px; padding-right: 30px">
                <form action="{{url('parse')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Parse Data
                    </button>
                </form>
            </li>
            <li style="padding-top: 10px; padding-right: 30px">
                <form action="{{url('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
