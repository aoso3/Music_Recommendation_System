@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')
    <style>
        body {

            background: url({{ URL::asset('images/1.jpg')}}) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            overflow:hidden;
            zoom: 85%;
            -moz-transform: scale(85%);
            -moz-transform-origin: 0 0;
        }

        .ui-autocomplete {
            max-height: 200px;
            max-width: 760px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            direction: ltr;

        }



    </style>
    <script src="{{ URL::asset('js/sigma/src/sigma.core.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/conrad.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/utils/sigma.utils.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/utils/sigma.polyfills.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/sigma.settings.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/classes/sigma.classes.dispatcher.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/classes/sigma.classes.configurable.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/classes/sigma.classes.graph.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/classes/sigma.classes.camera.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/classes/sigma.classes.quad.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/classes/sigma.classes.edgequad.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/captors/sigma.captors.mouse.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/captors/sigma.captors.touch.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/sigma.renderers.canvas.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/sigma.renderers.webgl.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/sigma.renderers.svg.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/sigma.renderers.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/webgl/sigma.webgl.nodes.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/webgl/sigma.webgl.nodes.fast.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/webgl/sigma.webgl.edges.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/webgl/sigma.webgl.edges.fast.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/webgl/sigma.webgl.edges.arrow.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.labels.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.hovers.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.nodes.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edges.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edges.curve.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edges.arrow.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edges.curvedArrow.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edgehovers.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edgehovers.curve.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edgehovers.arrow.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.edgehovers.curvedArrow.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/canvas/sigma.canvas.extremities.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/svg/sigma.svg.utils.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/svg/sigma.svg.nodes.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/svg/sigma.svg.edges.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/svg/sigma.svg.edges.curve.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/svg/sigma.svg.labels.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/renderers/svg/sigma.svg.hovers.def.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/middlewares/sigma.middlewares.rescale.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/middlewares/sigma.middlewares.copy.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/misc/sigma.misc.animation.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/misc/sigma.misc.bindEvents.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/misc/sigma.misc.bindDOMEvents.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/src/misc/sigma.misc.drawHovers.js')}}"></script>
    <!-- END SIGMA IMPORTS -->
    <script src="{{ URL::asset('js/sigma/plugins/sigma.plugins.neighborhoods/sigma.plugins.neighborhoods.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/plugins/sigma.layout.forceAtlas2/supervisor.js')}}"></script>
    <script src="{{ URL::asset('js/sigma/plugins/sigma.layout.forceAtlas2/worker.js')}}"></script>
    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-2.1.1.min.js')}}"></script>
    <script src="{{ URL::asset('js/jquery-ui.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('js/endorse_modernizr.js')}}"></script>
    <script src="{{ URL::asset('js/endorse_main.js')}}"></script>

    <link href="{{ URL::asset('css/modern.css')}}" rel="stylesheet">

    <script src="{{ URL::asset('js/jquery.easing.1.3.js')}}"></script>
    <script src="{{ URL::asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{ URL::asset('js/new.js')}}"></script>

    <script type="text/javascript">

        var player;
        jQuery(document).ready(function($){

            var settings = {
                instanceName:"modern",
                sourcePath:"",
                playlistList:"#playlist-list",
                activePlaylist:"playlist-audio1",
                activeItem:0,
                volume:0.5,
                autoPlay:false,
                preload:"auto",
                randomPlay:false,
                loopingOn:true,
                mediaEndAction:"next",
                soundCloudAppId:"",
                usePlaylistScroll:true,
                playlistScrollOrientation:"vertical",
                playlistScrollTheme:"minimal",
                useKeyboardNavigationForPlayback:true,
                createDownloadIconsInPlaylist:false,
                createLinkIconsInPlaylist:false,
                facebookAppId:"",
                useNumbersInPlaylist: false,
                numberTitleSeparator: ".  ",
                artistTitleSeparator: " - ",
                sortableTracks: false,
                playlistItemContent:"title,thumb",
                useMediaSession:true,
                useStatistics:false,
            };

            player = $("#wrapper").on('clickPlaylistItem', function(){
                togglePlaylist('close');
            }).hap(settings);

            //toggle playlist
            $(".playlist-toggle").on('click',function(){
                togglePlaylist('open');
            });
            $(".playlist-close").on('click',function(){
                togglePlaylist('close');
            });

            var playerHolder = $('.player-holder'),
                playlistHolder = $('.playlist-holder'),
                ease = 'easeInOutCubic',
                time = 500;

            function togglePlaylist(dir){

                if(dir == 'close'){
                    playlistHolder.stop().animate({'left': -playlistHolder.width()+'px'},{duration: time, easing: ease, complete: function(){
                        if(player.forcePlayback){
                            player.playMedia();
                            player.forcePlayback = false;
                        }
                    }});
                    playerHolder.stop().animate({'left': 0+'px'},{duration:time, easing: ease});

                }else{

                    player.forcePlayback = player.getMediaPlaying();
                    if(player.forcePlayback)player.pauseMedia();

                    playlistHolder.css({left: -playlistHolder.width()+'px', display:'block'}).stop().animate({'left': 0+'px'},{duration:time, easing: ease});
                    playerHolder.stop().animate({'left': playerHolder.width()+'px'},{duration:time, easing: ease});
                }

            }

        });

    </script>


    <form id="form2" name="submitform"  action="" method="get">

        <div class="navbar navbar-static navbar-default navbar-fixed-top" style="border-bottom:4px solid  #2c3e50;z-index: 1;border-bottom: 0;background-color:transparent" >
            <div class="row search-bar" style="padding-bottom: 0px; margin-bottom: 0px" >
                <div class="col-xs-2 col-md-2 pull-right text-center " style="margin-top: 4px;">
                    <a >
                        <img class="logo_img" src="{{ URL::asset('images/logo2.png')}}" style="width:120px;"/>
                    </a>
                </div>
                <?php
                if( (Session::get('logged_in')) == 1):
                ?>
                <section class="cd-section col-xs-2 col-md-2 pull-right" style="margin-top: -15px; margin-right: -60px">
                    <a id="endorse_btn" class="cd-bouncy-nav-trigger" href="#0" style="padding: 10px 10px">Endorse Songs</a>
                </section> <!-- .cd-section -->
                <?php endif; ?>
                <div class="cd-bouncy-nav-modal">
                    <nav>
                        <ul class="cd-bouncy-nav">

                        </ul>
                    </nav>


                    <a href="#0" class="cd-close">Close modal</a>
                </div> <!-- cd-bouncy-nav-modal -->


                <div class="col-md-6 col-md-offset-0 row">
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-md-offset-0" style="margin-left:30px; margin-top: 2px">
                        <div class="ui-widget" style="margin-top: 5px">
                            <button type="submit" id="btnSearch" class=" btn btn-default search-btn">
                                <span class="glyphicon glyphicon-search btn_span"></span>
                            </button>
                            <input type="text" id = "myTextbox2"  name="search_text" class='form-control' autocomplete="off" value="{{Request::get('search_text')}}"  style=" direction: ltr;">


                            <script>
                                var songs_names2 = [
                                    'Alan Walker - Alone',
                                    'Alan Walker - Sing Me To Sleep',
                                    'The Chainsmokers & Coldplay - Something Just Like This'

                                ];

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $('#myTextbox2').on('input', function() {

                                    $.ajax({
                                        url :"{{action('Home@autocomplete')}}",
                                        type: "POST",
                                        data : {
                                            search_text : $('#myTextbox2').val(),
                                        },
                                        success: function(data)
                                        {
                                            if(data) {
                                                var songs_names2 = [];
//                                            console.log(data[0]);
                                                for (i = 0; i < data.length; i++) {
                                                    songs_names2.push(data[i]['_source']['song']);
                                                    console.log(data[i]['_source']['song']);

                                                }

                                                $( "#myTextbox2" ).autocomplete({
                                                    source: songs_names2,
                                                    change: function (event, ui) {
                                                        if(!ui.item){

                                                            $("#myTextbox2").val("");
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
                                        $("#myTextbox2").click();
                                    }
                                });

                                $( "#form2" ).submit(function( event ) {
                                    if($("#myTextbox2").val() == "")
                                        event.preventDefault();
                                });



                            </script>




                        </div>
                    </div>
                </div>


            </div>
        </div>
    </form>

    <div id="container">
        <style>
            #graph-container {
                top: 45px;
                bottom: 0;
                left: 0;
                right: 0;
                position: absolute;
                height: 86%;

            }
            .sigma-svg{
                position: relative;
            }

        </style>
        <div id="graph-container" ></div>
    </div>
    <script>


        function playSound(filename){
            path = '{{ URL::asset('songs') }}'+ '/' + filename;

            document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="' + path + '.mp3" type="audio/mpeg" /><source src="' + path + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + path +'.mp3" /></audio>';

        }


        var songs_graph = <?php echo json_encode($good_response); ?>;
        var endorses = <?php echo json_encode($response_endorses); ?>;


        var i,
            s,
            N = songs_graph.length,
            E = N * 3,
            k = 0,
            d = 0.5,
            cs = [],
            g = {
                nodes: [],
                edges: []
            };

        if(N > 20)
            E = 60;

        // Generate a random graph:

        var colors = ["9a1b1f", "b51e5a", "6a0e13", "ef3d4b", "982065", "7c232b", "9a2f56", "9f1d20", "5d3168", "991c1f", "66314c", "c42639", "8c3e4b", "562b46", "702f2f"];
        // Generate a random graph:
        for (i = 0; i < colors.length ; i++)
            cs.push({
                id: i,
                nodes: [],
                color: '#' + colors[i]
            });

        for (i = colors.length - 1; i < N; i++)
            cs.push({
                id: i,
                nodes: [],
                color: '#' + (
                    Math.floor(Math.random() * 16777215).toString(16)
                ).substr(0, 6)
            });

//        console.log(endorses[0]['_source']['like']);
//        console.log(songs_graph[0]['id']);

        for (i = 0; i < N; i++) {
            var label = "";
            if(songs_graph[i]['song'].length > 25)
                label = songs_graph[i]['song'].substring(0,25) + "...";
            else
                label = songs_graph[i]['song'];

            o = cs[(Math.random() * N) | 0];

//            //endorse
//                g
            if(i != 0){
                var added = false;

                for( j=0 ; j < endorses.length ; j++ ) {
                    if (endorses[j]['_source']['song1'] == songs_graph[0]["id"] && endorses[j]['_source']['song2'] == songs_graph[i]["id"] && endorses[j]['_source']['like'] == 1) {
                        $(".cd-bouncy-nav").append('<li style="background-color: transparent;height:154px"><a style="pointer-events: none;padding: 3px 0px;" class="like " id="' + i + '" href="#0"><div class="glyphicon glyphicon-heart" id="' + i + '" style="margin-top: 6px"></div></a><a class="dislike" " id="' + i + '" href="#0">' + songs_graph[i]["song"].substring(0, 35) + "..." + '</a></li>');
                        added = true;
                        break;
                    }
                    else if (endorses[j]['_source']['song1'] == songs_graph[0]["id"] && endorses[j]['_source']['song2'] == songs_graph[i]["id"] && endorses[j]['_source']['like'] == -1) {
                        $(".cd-bouncy-nav").append('<li style="background-color: transparent;height:154px"><a style="padding: 3px 0px;" class="like " id="' + i + '" href="#0"><div class="glyphicon glyphicon-heart" id="' + i + '" style="margin-top: 6px"></div></a><a style="pointer-events: none;" class="dislike" " id="' + i + '" href="#0">' + songs_graph[i]["song"].substring(0, 35) + "..." + '</a></li>');
                        added = true;
                        break;
                    }

                }
                if(! added)
                    $(".cd-bouncy-nav").append('<li style="background-color: transparent;height:154px"><a style="padding: 3px 0px;" class="like " id="' + i + '" href="#0"><div class="glyphicon glyphicon-heart" id="' + i + '" style="margin-top: 6px"></div></a><a class="dislike" " id="' + i + '" href="#0">' + songs_graph[i]["song"].substring(0, 35) + "..." + '</a></li>');

            }


            g.nodes.push({
                    id: 'n' + i,
                    label: label,
                    x: songs_graph[i]['x'],
                    y: songs_graph[i]['y'],
                    size: 5000,
                    color: o.color,
                });
                k++;
                o.nodes.push('n' + i);


        }

        for (i = 0; i < N ; i++)
            g.edges.push({
                id: 'e' + i,
                source: 'n' + 0,
                target: 'n' + i,
                size: 15,
                color: '#ccc',
                type: ['curve'][Math.random() * 4 | 0]

            });


        $(".dislike").on('click', function() {

            var user_id = <?php echo json_encode((Session::get('id'))) ?>;
            var i = $(this).attr("id");
            console.log($(this).css("pointer-events","none"));
            console.log($(this).prev('a').css("pointer-events","auto"));
            $.ajax({
                url :"{{action('Home@endorse')}}",
                type: "POST",
                data : {
                    id : user_id,
                    type : "dislike",
                    song : songs_graph[i]['song'],
                    x : songs_graph[i]['x'],
                    y : songs_graph[i]['y'],
                    index1 : songs_graph[0]['id'],
                    index2 : songs_graph[i]['id'],
                },
                success: function(data)
                {
//                    if(data) {
//                    console.log($(this).prev('a').css("background-color","red"));
//                    console.log($(this).next('a').css("background-color","red"));
//                    console.log($(this).attr("id"));

//                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
//                    alert(xhr.status);
//                    alert(xhr.responseText);
//                    alert(thrownError);
                }

            });


        });

        $(".like").on('click', function() {

            var user_id = <?php echo json_encode((Session::get('id'))) ?>;
            var i = $(this).attr("id");
            console.log($(this).css("pointer-events","none"));
            console.log($(this).next('a').css("pointer-events","auto"));
            $.ajax({
                url :"{{action('Home@endorse')}}",
                type: "POST",
                data : {
                    id : user_id,
                    type : "like",
                    song : songs_graph[i]['song'],
                    x : songs_graph[i]['x'],
                    y : songs_graph[i]['y'],
                    index1 : songs_graph[0]['id'],
                    index2 : songs_graph[i]['id'],
                },
                success: function(data)
                {
                    if(data) {
                        console.log(data);

                    }
                    else
                        console.log("eeee");

                },
                error: function (xhr, ajaxOptions, thrownError) {
//                                         alert(xhr.status);
//                                         alert(xhr.responseText);
//                                         alert(thrownError);
                }

            });

        });












        // Instantiate sigma:
        s = new sigma({
            graph: g,
            settings: {
                enableHovering: false,
                edgeLabelSize: 'proportional',
                doubleClickEnabled: false,
                enableEdgeHovering: true,
                edgeHoverColor: 'edge',
                edgeHoverSizeRatio: 1,
                edgeHoverExtremities: true,
                defaultLabelColor: '#ecf0f1',
                labelColor: '#ecf0f1',
                fontStyle: "Comic Sans MS cursive",
                defaultNodeColor:"#ee9a45",
                minNodeSize : 10,
                maxNodeSize : 20,
                zoomingRatio : 1,
                maxEdgeSize : 3,
                autoResize : false,
                enableCamera : false


            }
        });

        s.addRenderer({
            id: 'main',
            type: 'svg',
            container: document.getElementById('graph-container'),
            freeStyle: true,


        });

        s.refresh();

//        // Binding silly interactions
//        function mute(node) {
//            if (!~node.getAttribute('class').search(/muted/))
//                node.setAttributeNS(null, 'class', node.getAttribute('class') + ' muted');
//        }
//
//        function unmute(node) {
//            node.setAttributeNS(null, 'class', node.getAttribute('class').replace(/(\s|^)muted(\s|$)/g, '$2'));
//        }

        $('.sigma-node').click(function() {
//            playSound($(this).attr("fill"));
            var str = $(this).attr("data-node-id");
            var song_id = str.substring(1,str.length);
//            alert(song_id);

            playSound(songs_graph[song_id]['song']);


//            // Muting
//            $('.sigma-node, .sigma-edge').each(function() {
//                mute(this);
//            });
//
//            // Unmuting neighbors
//            var neighbors = s.graph.neighborhood($(this).attr('data-node-id'));
//            neighbors.nodes.forEach(function(node) {
//                unmute($('[data-node-id="' + node.id + '"]')[0]);
//            });
//
//            neighbors.edges.forEach(function(edge) {
//                unmute($('[data-edge-id="' + edge.id + '"]')[0]);
//            });

        });

//        s.bind('clickStage', function() {
//            $('.sigma-node, .sigma-edge').each(function() {
//                unmute(this);
//            });
//        });



        var k=1,max = -1;
        $('.sigma-node, .sigma-edge').each(function() {
            if($(this).attr('data-node-id')) {
                var l = parseInt(this.getAttributeNS(null, 'r')) + ( 1 / parseInt($(this).attr('data-node-id').substr(1, 2))) * 30;
               if(l>max)
                   max = l;

                if(parseInt($(this).attr('data-node-id').substr(1, 2)) == 0)
                        l = 50;

                this.setAttributeNS(null, 'r',  parseInt(l));
            }
        });



        $(".sigma-svg").css("position","relative");
        //  $(".sigma-edge").attr("stroke-width",3);

    </script>
    <audio id="sound"></audio>



    <!-- player code -->
    <div id="wrapper" style="float:left;top:40%; zoom:80%">


            <div class="playlist-holder">

                <div class="playlist-top-bar">
                    <div class="playlist-close" data-tooltip="Back"><i class="fa fa-long-arrow-left icon icon-color"></i></div>

                    <div class="sort-alpha" data-tooltip="Alphabetic sort"><i class="fa fa-sort-alpha-desc sr-bar-i icon-color"></i></div>
                    <input class="search-filter" type="text" value="filter...">
                </div>

                <div class="playlist-filter-msg"><p>NOTHING FOUND!</p></div>

                <div class="playlist-inner">
                    <div class="playlist-content">
                        <!-- playlist items are appended here! -->
                    </div>
                </div>

            </div>


                <div class="bottom-cont">

                    <div class="player-controls">

                        <p class="player-artist"></p>
                        <div class="loop-toggle" data-tooltip="Loop"><i class="fa fa-refresh icon icon-color"></i></div>

                        <div class="player-controls-center">
                            <div class="prev-toggle"><i class="fa fa-backward icon icon-color"></i></div>
                            <div class="playback-toggle"><i class="fa fa-play icon icon-color"></i></div>
                            <div class="next-toggle"><i class="fa fa-forward icon icon-color"></i></div>
                        </div>

                        <div class="random-toggle" data-tooltip="Shuffle"><i class="fa fa-random icon icon-color"></i></div>

                    </div>

                    <div class="seekbar">
                        <p class="media-time-current">0:00</p>

                        <div class="progress-bg"></div>
                        <div class="load-level"></div>
                        <div class="progress-level"></div>

                        <p class="media-time-total">0:00</p>
                    </div>



                </div>




        <div class="tooltip"><p></p></div>

    </div>


    <!-- PLAYLIST LIST -->
    <div id="playlist-list">
        <ul id="playlist-audio1">

        </ul>

        <ul id="playlist-audio2">



        </ul>

    </div>

<script>
    for (i = 0; i < songs_graph.length; i++) {
            path = '{{ URL::asset('songs') }}'+ '/' + songs_graph[i]["song"];
            song = songs_graph[i]["song"].substr(0,50);
            $("#playlist-audio1").append('<li class="playlist-item" data-type="audio" data-mp3="'+path+'.mp3" data-download="media/audio/02.mp3" data-artist="'+song+'" data-title="A Way To The Top" data-album="Soundroll Greatest Hits" data-thumb="media/thumbs/1/02.jpg"></li>');
    }



    $(".playback-toggle").on('click', function(){
        console.log("aaa");
        document.getElementById("sound").innerHTML='<audio autoplay="autoplay"></audio>';

    })
</script>

@stop