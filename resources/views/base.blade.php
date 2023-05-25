<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}} </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/svg/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>

<body>
<div class="layer"></div>
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
    @include('_partials._siderbar')
    <div class="main-wrapper">
        @include('_partials._header')
        <main class="main users chart-page" id="skip-target">
            @include("_partials.errors-and-messages")
            @yield('content')
        </main>

<!-- ! Footer -->
<footer class="footer">
    <div class="container footer--flex">
        <div class="footer-start">
            <p><script>document.write(new Date().getFullYear())</script> &copy; {{env('APP_NAME')}}- <a href="#" target="_blank"
                                             rel="noopener noreferrer">{{env('APP_NAME')}}</a></p>
        </div>
        <ul class="footer-end">
           {{-- <li><a href="##">About</a></li>
            <li><a href="##">Support</a></li>
            <li><a href="##">Puchase</a></li>--}}
        </ul>
    </div>
</footer>
</div>
</div>
<script src="{{asset('js/jquery.min.js') }}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- Chart library -->
<script src="{{asset('js/chart.min.js') }}"></script>
<!-- Icons library -->
<script src="{{asset('js/feather.min.js') }}"></script>
<!-- Custom scripts -->

<script src="{{asset('js/script.js') }}"></script>
<script>
    var configs={
        routes:{
            index: "{{\Illuminate\Support\Facades\URL::to('/')}}",
            addpiecetable: "{{\Illuminate\Support\Facades\URL::route('fiche.addpieceline')}}",
        }
    }
    $(function () {
        //Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        $('#addpiece').click(function () {
            $.ajax({
                url: configs.routes.addpiecetable,
                type: "GET",
                dataType: "JSON",
                data: {
                    'item':$('#piece option:selected').val(),
                    'quantite':$('#quantite').val(),
                    'fiche':$('#fiche').val(),
                    'operation':"add",
                },
                success: function (data) {
                    $("#table_piece>tbody").html('');
                    $.each(data.data, function (index, item) {
                        $("#table_piece>tbody:last").append("<tr id='" + item.id + "'><td>" +
                            "<span class='hidden' hidden>" + item.id + "</span></td>" +
                            "<td>" + item.libelle + "</td><td>" + item.quantite + "</td><td><a onclick='removeRow(" + item.id + ")' class='btn btn-sm btn-danger'>Del</a></td></tr>");
                   })
                },
                error: function (err) {
                    alert("An error ocurred while loading data ...");
                }
            });
        })
    })
    function removeRow(id) {
        line = "#line_" + id;
        $.ajax({
            url: configs.routes.addpiecetable,
            type: "GET",
            dataType: "JSON",
            data: {
                'item':id,
                'quantite':$('#quantite').val(),
                'fiche':$('#fiche').val(),
                'operation':"remove",
            },
            success: function (data) {
                $("#table_piece>tbody").html('');
                $.each(data.data, function (index, item) {
                    $("#table_piece>tbody:last").append("<tr id='" + item.id + "'><td>" +
                        "<span class='hidden' hidden>" + item.id + "</span></td>" +
                        "<td>" + item.libelle + "</td><td>" + item.quantite + "</td><td><a onclick='removeRow(" + item.id + ")' class='btn btn-sm btn-danger'>Del</a></td></tr>");
                })
            },
            error: function (err) {
                alert("An error ocurred while loading data ...");
            }
        });
    }
</script>
</body>

</html>
