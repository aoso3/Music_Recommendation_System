@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')
    <link href="{{ URL::asset('css/login-register.css')}}" rel="stylesheet">
    <script src="{{ URL::asset('js/login-register.js')}}"></script>

    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-2.1.1.min.js')}}"></script>
    <script src="{{ URL::asset('js/jquery-ui.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>


    <style>
        .ui-autocomplete {
            max-height: 200px;
            max-width: 750px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            direction: ltr;

        }

    </style>


    <title>Symphony</title>


<?php
if( (Session::get('logged_in')) == 0):
?>
    <div class="container">

        <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></div>

    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="social">
                                <img  src="{{ URL::asset('images/lg.png')}}" class="logo" />
                            </div>
                            <div class="division">
                                <div class="line l"></div>
                                <span>Symphony</span>
                                <div class="line r"></div>
                            </div>
                            <center><div class="error"></div></center>
                            <div class="form loginBox">
                                    <input id="log_email" class="form-control" type="text" placeholder="Email" name="email">
                                    <input id="log_password" class="form-control" type="password" placeholder="Password" name="password">
                                    <input id="log_sub" class="btn btn-default btn-login" type="button" value="Login" >
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display:none;">
                            <div class="form">
                                    <input id="reg_email" class="form-control" type="text" placeholder="Email" name="email">
                                    <input id="reg_password" class="form-control" type="password" placeholder="Password" name="password">
                                    <input id="reg_sub" class="btn btn-default btn-register" type="button"  value="Create account" name="commit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                    </div>
                    <div class="forgot register-footer" style="display:none">
                        <span>Already have an account?</span>
                        <a href="javascript: showLoginForm();">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
    <div class="container">
        <a id="logout" class="btn big-register" >Logout</a></div>
    </div>

    <?php endif; ?>



    <div class="container">

        <form id="form1"   action="{{ action('Home@search') }}" method="get">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img  src="{{ URL::asset('images/logo2.png')}}" class="logo" />
                </div>
                <center>
                <h1 style="font: 200 20px/1.5 Helvetica, Verdana, sans-serif;font-size: 20px;font-style: normal;font-variant: normal;font-weight: 500;line-height: 26.4px;color: #cdcecf;margin: 10px 0px">
                    search for you favorite songs, and get a big collection of similar ones
                </h1>
                </center>
                <div class="clearfix" ></div>
                <div class="col-md-8 col-md-offset-2 search_input" >
                    <div class="ui-widget">
                        <button type="submit" id="btnSearch" class=" btn btn-default search-btn" >
                            <span class="glyphicon glyphicon-search btn_span" ></span>
                        </button>
                        <input  id = "myTextbox1"  type="text"  name="search_text" class='form-control' autocomplete="off" placeholder="Enter a song name, Ex : Adele - Hello" style=" direction: ltr;">


                        <script>

                            var songs_names = [
                                'a'

                            ];

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('#myTextbox1').on('input', function() {
                                $.ajax({
                                    url :"{{action('Home@autocomplete')}}",
                                    type: "POST",
                                    data : {
                                        search_text : $('#myTextbox1').val(),
                                    },
                                    success: function(data)
                                    {
                                        if(data) {
                                            songs_names = [];
//                                            console.log(data);
                                            for (i = 0; i < data.length; i++) {
                                                songs_names.push(data[i]['_source']['song']);
//                                                console.log(data[i]['_source']['song']);

                                            }
                                            $( "#myTextbox1" ).autocomplete({
                                                source: songs_names,
                                                change: function (event, ui) {
                                                    if(!ui.item){

                                                        $("#myTextbox1").val("");
                                                    }

                                                }
                                            });

                                        }


                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
//                                         alert(xhr.status);
//                                         alert(xhr.responseText);
//                                         alert(thrownError);
                                    }

                                });




                            });

                            $(document).keypress(function(e) {
                                if(e.which == 13) {
                                    e.preventDefault();
                                    $("#myTextbox1").click();
                                }
                            });

                            $( "#form1" ).submit(function( event ) {
                                if($("#myTextbox1").val() == "")
                                    event.preventDefault();
                            });

                        </script>


                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>

        function shakeModal(text){
            $('#loginModal .modal-dialog').addClass('shake');
            $('.error').addClass('alert alert-danger').html(text);
            $('input[type="password"]').val('');
            setTimeout( function(){
                $('#loginModal .modal-dialog').removeClass('shake');
            }, 1000 );
        }

        $("#reg_sub").on('click', function() {
                console.log("in");
                var email = $('#reg_email').val();
                var password = $('#reg_password').val();

            $.ajax({
                url :"{{action('Auth@register')}}",
                type: "POST",
                data : {
                    user_email : email,
                    user_password : password
                },
            success: function(data)
            {
            if(data == "error") {
                shakeModal("This email already registered !");
            }
            else{
                location.reload();
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
//                alert(xhr.status);
//                alert(xhr.responseText);
//                alert(thrownError);
            }

            });


        });

        $("#log_sub").on('click', function() {
            console.log("in");
            var email = $('#log_email').val();
            var password = $('#log_password').val();

            $.ajax({
                url :"{{action('Auth@login')}}",
                type: "POST",
                data : {
                    user_email : email,
                    user_password : password
                },
                success: function(data)
                {
                    if(data == "error") {
                       shakeModal("Invalid email/password combination !");
                    }
                    else{
                        location.reload();
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
//                alert(xhr.status);
//                alert(xhr.responseText);
//                alert(thrownError);
                }

            });


        });
        $("#logout").on('click', function() {
            $.ajax({
                url :"{{action('Auth@logout')}}",
                type: "POST",

                success: function(data)
                {
//                    alert(data);
                     location.reload();

                },
                error: function (xhr, ajaxOptions, thrownError) {
//                alert(xhr.status);
//                alert(xhr.responseText);
//                alert(thrownError);
                }

            });


        });


    </script>

@stop


