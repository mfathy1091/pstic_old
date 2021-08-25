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
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Add New Referral</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection

@section('content')
    <!-- row -->
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card col-12">
            <div class="card-body">
                <form action="{{ route('psscases.store') }}" method="post">
                    @csrf

                    <h5 class="card-title text-primary">Beneficiaries</h5><br>

                    <input id="direct_individual_id" type="hidden" name="direct_individual_id" class="form-control" value="{{ $directIndividual->id }}">

                    <div class="form-group">
                        <label for="direct_individual_name" class="mr-sm-2">Direct Beneficiary</label>
                        <input id="direct_individual_name disabled" type="text" name="direct_individual_name" class="form-control" value="{{ $directIndividual->name }}" disabled>
                    </div>

                    <label for="indirect_individuals_ids" class="mr-sm-2">Related individuals (related to same file number)</label>
                    @if (!$indirectIndividuals->isEmpty())
                        <div class="form-group border p-2">
                            @foreach ($indirectIndividuals as $indirectIndividual)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="indirect_individuals_ids[]"
                                        value="{{ $indirectIndividual->id }}" id="{{ $indirectIndividual->name }}">
                                    <label class="form-check-label" for="{{ $indirectIndividual->name }}">{{ $indirectIndividual->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="d-flex justify-content-left">N/A</div>
                    @endif

                    


                    <br><hr>

                    <h5 class="card-title text-primary">Referral Details</h5><br>

                    <div class="form-group">
                        <label for="referral_date">Referral Date</label>
                        <div class='input-group date'>
                            <input id="referral_date" name="referral_date" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" autocomplete="off" required>
                        </div>
                        @error('referral_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="inputCity">Referral Source</label>
                        <select class="custom-select" name="referral_source_id">
                            <option selected>Select Source</option>
                            @foreach($referralSources as $referralSource)
                                <option value="{{$referralSource->id}}">{{$referralSource->name}}</option>
                            @endforeach
                        </select>
                        @error('referral_source_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="referring_person_name" class="mr-sm-2">Referring Person Name</label>
                        <input id="referring_person_name" type="text" name="referring_person_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="referring_person_email" class="mr-sm-2">Referring Person Email</label>
                        <input id="referring_person_email" type="text" name="referring_person_email" class="form-control">
                    </div>

                    <label for="reasons_ids" class="mr-sm-2">Reasons Of Referral</label>
                    <div class="form-group border p-2">
                        @foreach ($reasons as $reason)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="reasons_ids[]"
                                    value="{{ $reason->id }}" id="{{ $reason->name }}">
                                <label class="form-check-label" for="{{ $reason->name }}">{{ $reason->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Save</button>
                    </div>

                </form>

            </div>
        </div>

    <!-- row closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>

    <script>
        $( "#referral_date" ).datepicker({
            format: "dd/mm/yy",
            weekStart: 3,
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: false,
            rtl: true,
            orientation: "auto"
            });
    </script>
@endsection




