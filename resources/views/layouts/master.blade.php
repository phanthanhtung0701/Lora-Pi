<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/node.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/node.css') }}" rel="stylesheet">


    <title>Monitor</title>
</head>
<body>
<div class="container">
    <div class="py-4 text-center">
{{--        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">--}}
        <h2>Hệ thống điều khiển chiếu sáng</h2>
    </div>
    <div class="py-2">
        <div class="btn-group">
            <button type="button" id="start" class="btn btn-lg btn-success">BẬT TOÀN BỘ</button>
            <button type="button" id="stop" class="btn btn-lg btn-secondary">TẮT TOÀN BỘ</button>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 text-center">
        @foreach ($data as $node)
            <div class="col">
                <div class="card mb-4 shadow-sm" id="node-{{$node['id']}}">
                    <div class="card-header">
{{--                        <div class="d-flex justify-content-between">--}}
{{--                            <button type="button" class="btn btn-circle btn-sm {{$node['status']==17?'btn-danger':'btn-primary'}}"></button>--}}
                            <h4 class="my-0 fw-normal">{{$node['name']}}</h4>
{{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <h2 class="card-title node-position" id="po-{{$node['id']}}">{{$node['position']}} </h2>
                        <h2 class="card-body node-status" id="st-{{$node['id']}}">{{$node['status']==1?'ON':'OFF'}} </h2>

                        <div class="btn-group">
                            <button type="button" id="start-{{$node['id']}}" class="w-100 btn btn-lg btn-success">BẬT</button>
                            <button type="button" id="stop-{{$node['id']}}" class="w-100 btn btn-lg btn-secondary">TẮT</button>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
{{--        @foreach($modules as $module)--}}
{{--            @if($module->name == 'banner' || $module->name == 'about' || $module->name=='stats' || $module->name == 'about_main')--}}
{{--                @include('user.'.$module->name)--}}
{{--            @endif--}}
{{--        @endforeach--}}

    </div>
</div>
</body>
<footer class="container">
    <div>
        <button class="btn-on btn"></button> Đèn bật
        <button class="btn-off btn"></button> Đèn tắt
        <button class="btn-err btn"></button> Đèn lỗi
    </div>
</footer>
</html>

