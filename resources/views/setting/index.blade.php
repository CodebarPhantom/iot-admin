@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1 class="m-0 text-dark">Settings</h1>
@stop

@section('adminlte_css_pre')
    
    
@stop

@section('content')    

    <div class="row">
        <div class="col-sm-12 col-md-4">    
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-envelope"></i>
                        &nbsp; Email Notification
                    </h3>
                </div>
                <div class="card-body"> 
                    <form action="{{ route('email.notification') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">  
                            <div class="form-group">
                                <select class="form-control select2" required style="width: 100%;" name="email_notification"> 
                                    <option>Pilih Aksi</option>                         
                                    <option value="0">Off</option>
                                    <option value="1">On</option>
                                </select>
                            </div>                      
                        </div>
                        <div class="col-6">  
                            <div class="form-group">
                                <button  type="submit" class="btn btn-block btn-primary">Send</button>
                            </div>                 
                        </div>
                    </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    
@stop

@section('script')    
    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select2').select2();
            var table = $('#datatable_1').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            language: {
                emptyTable: "{{ __('No data available in table') }}",
                info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
                infoFiltered: "({{ __('filtered from _MAX_ total entries') }})",
                lengthMenu: "{{ __('Show _MENU_ entries') }}",
                loadingRecords: "{{ __('Loading') }}...",
                processing: "{{ __('Processing') }}...",
                search: "{{ __('Search') }}",
                zeroRecords: "{{ __('No matching records found') }}"
            },
            ajax: {
                method: 'POST',
                url: "{{route('log-event.data')}}",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            },
            columns: [
                { title: "{{ __('Username') }}", data: 'username', name: 'users.name', defaultContent: '-', class: 'text-center' },
                { title: "{{ __('Information') }}", data: 'information', name: 'information', defaultContent: '-', class: 'text-center' },
                { title: "{{ __('Time') }}", data: 'created_at', name: 'created_at', defaultContent: '-', class: 'text-center', orderable: false, searchable: false },
            ]
        });
            
        
        });
    </script>

    <script type="text/javascript">
    
        

    </script>
@endsection
