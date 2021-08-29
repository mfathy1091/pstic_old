@extends('layouts.master')

@section('css')
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


<autocomplete-component></autocomplete-component>
<follow-ups>

    sdfsdf
</follow-ups>


            
            
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
                                        
                                        @if ($record->status->name == 'Inactive')
                                            <span class="badge badge-pill badge-secondary h-auto font-weight-bold font-italic">{{ $record->status->name }}</span>
                                        @elseif ($record->status->name == 'Active')
                                            <span class="badge badge-pill badge-success h-auto font-weight-bold font-italic">{{ $record->status->name }}</span>
                                        @endif
                                        
                                        @if ($record->is_new == '1')
                                            <span class="badge badge-pill badge-info h-auto font-weight-bold font-italic ml-2">New</span>
                                        @endif
                                        @if ($record->is_emergency == '1')
                                            <span class="text-muted ml-2 mr-2">|</span>
                                            <span class="badge badge-pill badge-danger h-auto font-weight-bold font-italic">Emergency</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div>click to expand</div>
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
                                @include('pss_cases.partials.services')
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

@endsection



