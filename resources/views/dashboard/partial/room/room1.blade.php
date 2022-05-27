@foreach ($lastStatusLamps1 as $lastStatusLamp1)        
<div class="col-10">  
    <div class="form-group">
        <span class="text-bold text-lg"><i id="light{{ $lastStatusLamp1->id }}" class="fa fa-lightbulb @if ($lastStatusLamp1->status == 1){{ 'text-warning' }} @endif"></i> Saklar {{-- $lastStatusLamp1->id --}}</span>
    </div>                      
</div>
<div class="col-2">
    <div class="form-group">
        <div class="custom-control custom-switch custom-switch-on custom-switch-on-success custom-switch-md">
        <input type="checkbox" class="form-control custom-control-input saklar" @if ($lastStatusLamp1->status == 1){{ 'checked' }}@endif data-light-id="{{ $lastStatusLamp1->id }}" id="lampu{{ $lastStatusLamp1->id }}">
        <label class="custom-control-label" for="lampu{{ $lastStatusLamp1->id }}"></label>
        </div>
    </div>
</div>                  
@endforeach   

@foreach ($lastStatusDoors as $lastStatusDoor)   
        <div class="col-6">  
            <div class="form-group">
                <span class="text-bold text-lg"><i id="door{{ $lastStatusDoor->id }}" class="fa @if($lastStatusDoor->status == 0){{ 'fa-door-open' }}@elseif($lastStatusDoor->status == 1){{ 'fa-door-closed' }}@endif"></i> Pintu {{-- $lastStatusDoor->id --}}</span>
            </div>                      
        </div>
        <div class="col-6">
            <div class="form-group">
                <button type="button" class="btn btn-block @if($lastStatusDoor->status == 0){{ 'btn-danger' }}@elseif($lastStatusDoor->status == 1){{ 'btn-success' }}@endif btn-flat">@if($lastStatusDoor->status == 0){{ 'Pintu Terbuka' }}@elseif($lastStatusDoor->status == 1){{ 'Pintu Tertutup' }}@endif</button>
            </div>
        </div>             
@endforeach  



<script>    
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
</script>