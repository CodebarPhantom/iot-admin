

@foreach ($lastStatusLamps2 as $lastStatusLamp2)        
<div class="col-10">  
    <div class="form-group">
        <span class="text-bold text-lg"><i id="light{{ $lastStatusLamp2->id }}" class="fa fa-lightbulb @if ($lastStatusLamp2->status == 1){{ 'text-warning' }} @endif"></i> Saklar {{-- $lastStatusLamp2->id --}}</span>
    </div>                      
</div>
<div class="col-2">
    <div class="form-group">
        <div class="custom-control custom-switch custom-switch-on custom-switch-on-success custom-switch-md">
        <input type="checkbox" class="form-control custom-control-input saklar" @if ($lastStatusLamp2->status == 1){{ 'checked' }}@endif data-light-id="{{ $lastStatusLamp2->id }}" id="lampu{{ $lastStatusLamp2->id }}">
        <label class="custom-control-label" for="lampu{{ $lastStatusLamp2->id }}"></label>
        </div>
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