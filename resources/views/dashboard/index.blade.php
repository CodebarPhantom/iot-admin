@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('adminlte_css_pre')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" type="text/css"  />
    <style type="text/css" >
         .stretch-card>.card {
                width: 100%;
                min-width: 100%
            }

            body {
                background-color: #f9f9fa
            }

            .flex {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto
            }

            @media (max-width:991.98px) {
                .padding {
                    padding: 1.5rem
                }
            }

            @media (max-width:767.98px) {
                .padding {
                    padding: 1rem
                }
            }

            .padding {
                padding: 5rem
            }

            .grid-margin,
            .purchace-popup>div {
                margin-bottom: 25px
            }

            .card {
                border: 0;
                border-radius: 2px
            }

            .card-weather {
                background: #e1ecff;
                background-image: linear-gradient(to left bottom, #d6eef6, #dff0fa, #e7f3fc, #eff6fe, #f6f9ff)
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0, 0, 0, 0.125);
                border-radius: 0.25rem
            }

            .card-weather .card-body:first-child {
                background: url({{asset('assets/images/dashboard/weather.svg')}}) no-repeat center;
                background-size: cover
            }

            .card .card-body {
                padding: 1.88rem 1.81rem
            }

            .card-body {
                flex: 1 1 auto;
                padding: 1.25rem
            }

            .card-weather .weather-date-location {
                padding: 0 0 38px
            }

            .h3,
            h3 {
                font-size: 1.56rem
            }

            .h1,
            .h2,
            .h3,
            .h4,
            .h5,
            .h6,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: "Poppins", sans-serif;
                font-weight: 500
            }

            .text-gray,
            .card-subtitle,
            .new-accounts ul.chats li.chat-persons a p.joined-date {
                color: #969696
            }

            p {
                font-size: 13px
            }

            .text-gray,
            .card-subtitle,
            .new-accounts ul.chats li.chat-persons a p.joined-date {
                color: #969696
            }

            .card-weather .weather-data {
                padding: 0 0 4.75rem
            }

            .mr-auto,
            .mx-auto {
                margin-right: auto !important
            }

            .display-3 {
                font-size: 2.5rem
            }

            .card-weather .card-body {
                background: #ffffff
            }

            .card-weather .weakly-weather {
                background: #ffffff;
                overflow-x: auto
            }

            .card-weather .weakly-weather .weakly-weather-item {
                flex: 0 0 14.28%;
                border-right: 1px solid #f2f2f2;
                padding: 1rem;
                text-align: center
            }

            .mb-0,
            .my-0 {
                margin-bottom: 0 !important
            }

            .card-weather .weakly-weather .weakly-weather-item i {
                font-size: 1.2rem
            }
    </style>
    <!-- form wizard -->
    <style type="text/css" >
        #msform {
                text-align: center;
                position: relative;
                margin-top: 20px
            }

            .form-card {
                text-align: left
            }

            #msform fieldset:not(:first-of-type) {
                display: none
            }


            #msform input:focus,
            #msform textarea:focus {
                -moz-box-shadow: none !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
                border: 1px solid #673AB7;
                outline-width: 0
            }

            #msform .action-button {
                width: 100px;
                background: #673AB7;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 0px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 0px 10px 5px;
                float: right
            }

            #msform .action-button:hover,
            #msform .action-button:focus {
                background-color: #311B92
            }

            #msform .action-button-previous {
                width: 100px;
                background: #616161;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 0px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 5px 10px 0px;
                float: right
            }

            #msform .action-button-previous:hover,
            #msform .action-button-previous:focus {
                background-color: #000000
            }

            .card {
                z-index: 0;
                border: none;
                position: relative
            }

            .fs-title {
                font-size: 25px;
                color: #673AB7;
                margin-bottom: 15px;
                font-weight: normal;
                text-align: left
            }

            .purple-text {
                color: #673AB7;
                font-weight: normal
            }

            .steps {
                font-size: 25px;
                color: gray;
                margin-bottom: 10px;
                font-weight: normal;
                text-align: right
            }

            .fieldlabels {
                color: gray;
                text-align: left
            }

            #progressbar {
                margin-bottom: 30px;
                overflow: hidden;
                color: lightgrey
            }

            #progressbar .active {
                color: #673AB7
            }

            #progressbar li {
                list-style-type: none;
                font-size: 15px;
                width: 25%;
                float: left;
                position: relative;
                font-weight: 400
            }

            #progressbar #account:before {
                font-family: FontAwesome;
                content: "\f13e"
            }

            #progressbar #personal:before {
                font-family: FontAwesome;
                content: "\f007"
            }

            #progressbar #payment:before {
                font-family: FontAwesome;
                content: "\f030"
            }

            #progressbar #confirm:before {
                font-family: FontAwesome;
                content: "\f00c"
            }

            #progressbar li:before {
                width: 50px;
                height: 50px;
                line-height: 45px;
                display: block;
                font-size: 20px;
                color: #ffffff;
                background: lightgray;
                border-radius: 50%;
                margin: 0 auto 10px auto;
                padding: 2px
            }

            #progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: lightgray;
                position: absolute;
                left: 0;
                top: 25px;
                z-index: -1
            }

            #progressbar li.active:before,
            #progressbar li.active:after {
                background: #673AB7
            }

            .progress {
                height: 20px
            }

            .progress-bar {
                background-color: #673AB7
            }

            .fit-image {
                width: 100%;
                object-fit: cover
            }
    </style>
@stop

@section('content') 

    <div class="row">
        <div class="col-12">              
            <div class="card card-weather">
                <div class="card-body">
                    <div class="weather-date-location">
                        <h3>{{ Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l') }}</h3>
                        <p class="text-gray"> <span class="weather-date">{{ Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y') }}</span> <span class="weather-location"> - Eryan Home, Karawang</span> </p>
                    </div>
                    <div class="weather-data d-flex">
                        <div class="mr-auto">
                            <h4 id="temperature" class="display-3">{{ number_format($lastTemperature->temperature,1) }} <span class="symbol">°</span>C</h4>
                            <p id="humidity" class="text-md"> {{ __('Kelembapan: '). number_format($lastHumidity->humidity).' %' }} </p>
                        </div>
                    </div>
                    <div class="chart">
                        <canvas id="line-chart" style="max-height: 450px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>     
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-couch"></i>
                        &nbsp; Ruang Utama
                    </h3>
                </div>
                <form role="form" action="{{ route('action.ac') }}" method="post">
                    @csrf
                <div class="card-body"> 
                    <div class="row" id="room1">
                        @include('dashboard.partial.room.room1')
                        
                    </div>  
                    <div class="row"> 
                        <div class="col-6">
                            <div class="form-group">
                                <select class="form-control select2" required style="width: 100%;" name="command"> 
                                    <option>Pilih Control</option>                         
                                    <option value="1">Off</option>
                                    <option value="2">On</option>
                                    <option value="3">20 °C</option>
                                    <option value="4">25 °C</option>
                                </select>
                            </div>    
                        </div>   
                        <div class="col-6">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-block btn-primary">AC</button>
                            </div>
                        </div> 
                    </div>           
                </div>
            </form>    
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-bed"></i>
                        &nbsp; Kamar Tidur Utama
                    </h3>
                </div>
                <form role="form" action="{{ route('action.ac') }}" method="post">
                    @csrf
                <div class="card-body"> 
                    <div class="row" id="room2">
                        @include('dashboard.partial.room.room2')
                        
                    </div>  
                    <div class="row">
                         
                        <div class="col-6">
                            <div class="form-group">
                                <select class="form-control select2" required style="width: 100%;" name="command"> 
                                    <option>Pilih Control</option>                         
                                    <option value="1">Off</option>
                                    <option value="2">On</option>
                                    <option value="3">20 °C</option>
                                    <option value="4">25 °C</option>
                                </select>
                            </div>    
                        </div>   
                        <div class="col-6">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-block btn-primary">AC</button>
                            </div>
                        </div> 
                    </div>           
                </div>
            </form>    
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-bed"></i>
                        &nbsp; Kamar Tidur Anak
                    </h3>
                </div>
                <form role="form" action="{{ route('action.ac') }}" method="post">
                    @csrf
                <div class="card-body"> 
                    <div class="row" id="room2">
                        @include('dashboard.partial.room.room3')
                        
                    </div>  
                    <div class="row">
                        
                        <div class="col-6">
                            <div class="form-group">
                                <select class="form-control select2" required style="width: 100%;" name="command"> 
                                    <option>Pilih Control</option>                         
                                    <option value="1">Off</option>
                                    <option value="2">On</option>
                                    <option value="3">20 °C</option>
                                    <option value="4">25 °C</option>
                                </select>
                            </div>    
                        </div>   
                        <div class="col-6">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-block btn-primary">AC</button>
                            </div>
                        </div> 
                    </div>           
                </div>
            </form>    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-4">

        </div>
        <div class="col-sm-12 col-md-4">

        </div>
        <div class="col-sm-12 col-md-4">

        </div>
    </div>
    
@stop

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>    
    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".saklar").click(function(e) {
                var selectedId = $(this).attr("data-light-id");
                var light = "#light"+selectedId;
                if($(selectedId).prop("checked")){ 
                    $(light).addClass('text-warning');
                }else if(!$(selectedId).prop("checked")){                    
                    $(light).removeClass('text-warning');
                } 
                $.get("http://{{$server}}/api/light-check?idlight="+selectedId+"&statuslight=2", function(data){
                    console.log(data);
                });
                
            }); 


            $('.select2').select2();
            

            var ctx = document.getElementById("line-chart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    
                    datasets: [{ 
                        data:[],
                        label: "Suhu",
                        borderColor: "#3e95cd",
                        fill: false
                    }
                    ]
                },
                options: {
                    title: {
                    display: false,
                    text: 'Suhu dan Kelembapan Hari Ini'
                    },
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines : {
                                display : false,
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                                display : false,
                            }
                        }]
                    }
                }
            });

            var updateChart = function() {
                $.ajax({
                    url: "{{ route('chart-temperature.update') }}",
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        myChart.data.labels = data.labels;
                        myChart.data.datasets[0].data = data.data;
                        myChart.update();

                       
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }
            
            

            var updateOverview = function(){
                $.ajax({
                    url: "{{ route('overview.update') }}",
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var humidity = data.lastHumidity;
                        var lastHumidity = String(humidity).substr(0, 2);

                        var temperature = data.lastTemperature;
                        var lastTemperature = String(temperature).substr(0, 4);


                        document.getElementById("humidity").innerHTML  =`Kelembapan: ${lastHumidity} %`;
                        document.getElementById("temperature").innerHTML  = `${lastTemperature} °C`;
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }


            /*var updateLampu = function(){
                $.ajax({
                    method: "get",                    
                    cache: false,
                    url: "{{ route('light.update') }}",
                    success: function (response) {
                        $('#statusLight').html(response)
                    },                               
                }); 
            }

            var updateDoor = function(){
                $.ajax({
                    method: "get",                    
                    cache: false,
                    url: "{{ route('door.update') }}",
                    success: function (response) {
                        $('#statusDoor').html(response)
                    },                               
                }
                
                ); 
            }*/

            var room1 = function(){
                $.ajax({
                    method: "get",                    
                    cache: false,
                    url: "{{ route('room1.update') }}",
                    success: function (response) {
                        $('#room1').html(response)
                    },                               
                }
                
                ); 
            }

            var room2 = function(){
                $.ajax({
                    method: "get",                    
                    cache: false,
                    url: "{{ route('room2.update') }}",
                    success: function (response) {
                        $('#room2').html(response)
                    },                               
                }
                
                ); 
            }

            var room3 = function(){
                $.ajax({
                    method: "get",                    
                    cache: false,
                    url: "{{ route('room3.update') }}",
                    success: function (response) {
                        $('#room3').html(response)
                    },                               
                }
                
                ); 
            }
            
            updateChart();
            updateOverview();
            setInterval(() => {
                updateChart();
                updateOverview();                
            }, 120000);

            setInterval(() => {
                //updateLampu();
                //updateDoor();   
                room1();  
                room2();  
                room3();          
            }, 3000);


            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;

            setProgressBar(current);

            $(".next").click(function () {

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(++current);
            });

            $(".previous").click(function () {

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(--current);
            });

            function setProgressBar(curStep) {
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width", percent + "%")
            }

            $(".submit").click(function () {
                return false;
            })
        
        });
    </script>

    <script>

    </script>
@endsection
