@foreach ($lastStatusDoors as $lastStatusDoor)   
        <div class="col-7">  
            <div class="form-group">
                <span class="text-bold text-lg"><i id="door{{ $lastStatusDoor->id }}" class="fa @if($lastStatusDoor->status == 0){{ 'fa-door-open' }}@elseif($lastStatusDoor->status == 1){{ 'fa-door-closed' }}@endif"></i> Pintu {{ $lastStatusDoor->id  }}</span>
            </div>                      
        </div>
        <div class="col-5">
            <div class="form-group">
                <button type="button" class="btn btn-block @if($lastStatusDoor->status == 0){{ 'btn-danger' }}@elseif($lastStatusDoor->status == 1){{ 'btn-success' }}@endif btn-flat">@if($lastStatusDoor->status == 0){{ 'Pintu Terbuka' }}@elseif($lastStatusDoor->status == 1){{ 'Pintu Tertutup' }}@endif</button>
            </div>
        </div>             
@endforeach  