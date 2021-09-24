<head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        @import url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

        .seminor-login-modal-body .close {
            position: relative;
            top: -45px;
            left: 10px;
            color: #1cd8ad;
        }

        .seminor-login-modal-body .close {
            opacity: 0.75;
        }

        .seminor-login-modal-body .close:focus,
        .seminor-login-modal-body .close:hover {
            color: #39e8b0;
            opacity: 1;
            text-decoration: none;
            outline: 0;
        }

        .seminor-login-modal .modal-dialog .modal-content {
            border-radius: 0px;
        }

        /* form animation */
        .seminor-login-form .form-group {
            position: relative;
            margin-bottom: 1.5em !important;
        }

        .seminor-login-form .form-control {
            border: 0px solid #ced4da !important;
            border-bottom: 1px solid #adadad !important;
            border-radius: 0 !important;
        }

        .seminor-login-form .form-control:focus,
        .seminor-login-form .form-control:active {
            outline: none !important;
            outline-width: 0;
            border-color: #adadad !important;
            box-shadow: 0 0 0 0.2rem transparent;
        }

        *:focus {
            outline: none;
        }

        .seminor-login-form {
            padding: 2em 0 0;
        }

        .form-control-placeholder {
            position: absolute;
            top: 0;
            padding: 7px 0 0 13px;
            transition: all 200ms;
            opacity: 0.5;
            border-top: 0px;
            border-left: 0;
            border-right: 0;
        }

        .form-control:focus + .form-control-placeholder,
        .form-control:valid + .form-control-placeholder {
            font-size: 75%;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0);
            opacity: 1;
        }

        .container-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark-box {
            position: absolute;
            top: -5px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #adadad;
        }

        .container-checkbox {
            display: block;
            position: relative;
            padding-left: 40px;
            margin-bottom: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            line-height: 1.1;
        }

        .container-checkbox input:checked ~ .checkmark-box:after {
            color: #fff;
        }

        .container-checkbox input:checked ~ .checkmark-box:after {
            display: block;
        }

        .container-checkbox .checkmark-box:after {
            left: 10px;
            top: 4px;
            width: 7px;
            height: 15px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .checkmark:after,
        .checkmark-box:after {
            content: "";
            position: absolute;
            display: none;
        }

        .container-checkbox input:checked ~ .checkmark-box {
            background-color: #f58220;
            border: 0px solid transparent;
        }

        .btn-check-log .btn-check-login {
            font-size: 16px;
            padding: 10px 0;
        }

        button.btn-check-login:hover {
            color: #fff;
            background-color: #f58220;
            border: 2px solid #f58220;
        }

        .btn-check-login {
            color: #f58220;
            background-color: transparent;
            border: 2px solid #f58220;
            transition: all ease-in-out .3s;
        }

        .btn-check-login {
            display: inline-block;
            padding: 12px 0;
            margin-bottom: 0;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border-radius: 0;
            width: 100%;
        }

        .forgot-pass-fau a {
            text-decoration: none !important;
            font-size: 14px;
        }

        .text-primary-fau {
            color: #1959a2;
        }

        .select-form-control-placeholder {
            font-size: 100%;
            padding: 7px 0 0 13px;
            margin: 0;
        }

        .modal {
            overflow-y: scroll;
        }
    </style>

</head>

<body>

<div class="container">
    <h2>Menu</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sem-login">
        Add Product
    </button>
    <a>|</a>
    <a href="/admins/categories">Category List </a>


    {{--        <form method="post">--}}
    {{--            @csrf--}}
    {{--            <button type="submit" name="category" formaction="{{url("/admins/categories/create")}}"--}}
    {{--                    class="btn btn-primary">--}}
    {{--                Add Category--}}
    {{--            </button>--}}
    {{--        </form>--}}


    <!-- List of the products -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td><a href="admins/{{$product->id}}/edit"> Edit </a></td>
                <td>
                    <form action="/admins/{{$product->id}}" method="POST" class="seminor-login-form">
                        @csrf
                        @method("DELETE")
                        <div class="btn-check-log">
                            <button type="submit" class="btn-check-login">Delete</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- The Modal Login -->
    <div class="modal fade seminor-login-modal" data-backdrop="static" id="sem-login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body seminor-login-modal-body">
                    <h5 class="modal-title text-center">LOGIN TO MY ACCOUNT</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                    </button>

                    <!-- After click should be displayed this -->
                    <form action="/admins/products/create" method="POST" class="seminor-login-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" required autocomplete="off">
                            <label class="form-control-placeholder" for="name">Name</label>
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" class="form-control" required autocomplete="off">
                            <label class="form-control-placeholder" for="price">Price</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="description" class="form-control" required autocomplete="off">
                            <label class="form-control-placeholder" for="description">Description</label>
                        </div>

                        <div class="btn-check-log">
                            <button type="submit" class="btn-check-login">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--            <!-- List of the products -->--}}
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">User email</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Confirmed</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($purchases as $purchase)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$purchase->user->email}}</td>
            <td>{{optional($purchase->product)->name}}</td>
            <td>{{$purchase->sold_price}}</td>
            <td>{{optional($purchase->product)->description}}</td>
            <td>{{$purchase->status}}</td>
            <td>
                <form method="post">
                    @csrf
                    <button type="submit" name="Confirm" formaction="{{url("/admins/{$purchase->id}/confirm")}}"
                            class="btn btn-primary">
                        Confirm
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
