@extends('adminlte::page')

@section('title', 'Log Events')

@section('content_header')
    <h1 class="m-0 text-dark">Log Events</h1>
@stop

@section('adminlte_css_pre')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet">
    
@stop

@section('content')    

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-database"></i>
                            &nbsp; Log Events
                    </h3>
                </div>
                <div class="card-body">                     
                    <div class="row">
                        <div class="table-responsive">  
                            <table class="table table-striped table-bordered dt-responsive nowrap" width="100%" id="datatable_1"></table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    
@stop

@section('script')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>   
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

   
    


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                { title: "{{ __('Username') }}", data: 'username', name: 'users.name', defaultContent: 'System Smart Home', class: 'text-center' },
                { title: "{{ __('Information') }}", data: 'information', name: 'information', defaultContent: '-', class: 'text-center' },
                { title: "{{ __('Time') }}", data: 'created_at', name: 'created_at', defaultContent: '-', class: 'text-center', orderable: false, searchable: false },
            ]
        });
            
        
        });
    </script>

    <script type="text/javascript">
    
        

    </script>
@endsection
