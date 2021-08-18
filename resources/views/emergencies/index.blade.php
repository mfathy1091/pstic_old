@extends('layouts.master')

@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection

@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">All Emergencies</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="form-group">
                    <select class="form-select" name="month_id">
                        <option selected>Select Month</option>
                        @foreach($months as $month)
                            <option value="{{$month->id}}">{{$month->name}}</option>
                        @endforeach
                    </select>
                    @error('month_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>

                <div class="table-responsive">
                    <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
                        data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="align-left">Date</th>                                                      
                                <th class="align-left">Comment</th>
                                <th class="align-left">Beneficaries</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emergencies as $emergency)
                                <tr>
                                    
                                    <td>{{ $emergency->emergency_date }}</td>
                                    <td>{{ $emergency->comment }}</td>
                                    <td>
                                        @foreach ($emergency->beneficiaries as $beneficiary)
                                            <div>
                                                <a href="{{ route('individuals.show', $beneficiary->individual->id) }}">
                                                    {{ $beneficiary->individual->name }}
                                                </a>
                                                @if ($beneficiary->is_direct === '1')
                                                    <span class="badge badge-pill badge-secondary ml-4 font-weight-bold font-italic">Direct</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            
            // fetch the data upon reload
            fetch_data();
            
            //fetch the data from search on keyup
            $(document).on('keyup', '#search', function() {
                var  query = $('#search').val();
                fetch_data(query);
            });

            function fetch_data(query = '')
            {
                $.ajax({
                    url: "{{ route('beneficiaries.action') }}",
                    method: 'GET',
                    data: {query:query},
                    dataType: 'json',
                    success:function(data){
                    $('#rows_container').html(data.record_rows);
                    $('#total_records').html(data.total_records);
                    }
                });
            }
        });
    </script>

@endsection


