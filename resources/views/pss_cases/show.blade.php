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
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">PSS Case Details</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection

@section('content')
<!-- row -->
    

            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5>Original Referral Details</h5>
                        <h5 class="text-primary">
                            {{ $referral->referralSource->name }} <span class="text-muted ml-2 mr-2">|</span> {{ $referral->referral_date }}
                            
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col mb-4">
                                <h6 class="card-subtitle mb-2 text-muted">Referral Source</h6>
                                <div class="ml-4">
                                    <li>{{ $referral->referralSource->name }}</li>
                                    <li>{{ $referral->referring_person_name }}</li>
                                    <li>{{ $referral->referring_person_email }}</li>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <h6 class="card-subtitle mb-2 text-muted">Reason of Referral</h6>
                                <div class="ml-4">
                                    <?php $reasons = $referral->reasons; ?>
                                    @foreach ($reasons as $reason)
                                        <li>{{ $reason->name }}</li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="card-header">
                        <h5 class="text-primary">
                            <a href="{{route('individuals.show', $pssCase->directIndividual->id)}}">
                                {{ $pssCase->directIndividual->name }}
                            </a>                            
                        </h5>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mb-4">
                                <h6 class="card-subtitle mb-2 text-muted">Assigned PSW: {{ $pssCase->assignedPsw->name }}</h6>
                                <div class="ml-4">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
            <h4 class="text-dark ml-4">Monthly Records</h4>
            {{-- Accordion List --}}
            <div class="accordion card-body" id="accordionExample">
                <?php $n = 0; ?>
                @foreach ($records as $record)
                <?php $n++; ?>
                    <div class="card">
                        {{-- Accordion Header --}}
                        <div class="card-header  bg-white" id="heading{{ $record->id }}">
                            <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $record->id }}" aria-expanded="true" aria-controls="collapse{{ $record->id }}">
                                
                                <div class="row">
                                    <div class="col">
                                        <span class="text-primary font-weight-bold text-capitalize mr-3">{{ $record->month->name }}</span>
                                        <span class="badge badge-pill badge-warning h-auto font-weight-bold font-italic">{{ $record->status->name }}</span>
                                        @if ($record->is_new == '1')
                                            <span class="badge badge-pill badge-success h-auto font-weight-bold font-italic ml-2">New</span>
                                        @endif
                                        @if ($record->is_emergency == '1')
                                            <span class="text-muted ml-2 mr-2">|</span>
                                            <span class="badge badge-pill badge-danger h-auto font-weight-bold font-italic">Emergency</span>
                                        @endif
                                    </div>
                                </div>

                                

                            </button>
                            </h2>
                        </div>
                        
                        {{-- Accordion Body --}}
                        <div id="collapse{{ $record->id }}" class="collapse {{-- {{ $n == '1' ? ' show' : '' }} --}}" aria-labelledby="heading{{ $record->id }}" data-parent="#accordionExample">
                            <div class="card-body">
                                <br>
                                <!-- Benefits and its modal-->
                                @include('pss_cases.partials.beneficiaries')
                                <!-- end benefits -->

                                <br><hr>

                                <!-- Follow Ups and its modal-->
                                @include('pss_cases.partials.follow_ups')
                                <!-- End Follow Ups -->
                                
                                <br><hr>

                                <!-- Benefits and its modal-->
                                @include('pss_cases.partials.benefits')
                                <!-- end benefits -->


                                <br><hr>

                                <!-- Benefits and its modal-->
                                @include('pss_cases.partials.emergencies')
                                <!-- end benefits -->

                                <br><hr>

                                <!-- Benefits and its modal-->
                                @include('pss_cases.partials.risks')
                                <!-- end benefits -->
                
                            </div>
                        </div>
                    </div>
                    {{-- End Accordion 1 --}}
                @endforeach
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
@endsection



