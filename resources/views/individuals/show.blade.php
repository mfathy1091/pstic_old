@extends('layouts.master')
@section('css')
@endsection
@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Individual Details</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<?php $file = $individual->file; ?>
<div class="card">
    <div class="card-body">

        <h5 class="card-title text-primary">{{ $individual->name }}</h5>
        <hr>

        <div class="form-group">
            <strong>File Number:</strong>
            {{ $individual->file->number }}
            <a href="{{route('files.show',$file->id)}}" class="ml-3 font-italic" role="button" aria-pressed="true">Show File</a>
        </div>
        
        <div class="form-group">
            <strong>Individual ID:</strong>
            {{ $individual->individual_id }}
        </div>
        
        <div class="form-group">
            <strong>Passport Number:</strong>
            {{ $individual->passport_number }}
        </div>

        <div class="form-group">
            <strong>Name:</strong>
            {{ $individual->name }}
        </div>
        
        <div class="form-group">
            <strong>Native Name:</strong>
            {{ $individual->native_name }}
        </div>

        <div class="form-group">
            <strong>Age:</strong>
            {{ $individual->age }}
        </div>

        <div class="form-group">
            <strong>Gender:</strong>
            {{ $individual->gender->name }}
        </div>

        <div class="form-group">
            <strong>Nationality:</strong>
            {{ $individual->nationality->name }}
        </div>

        <div class="form-group">
            <strong>Relationship:</strong>
            {{ $individual->relationship->name }}
        </div>

        <div class="form-group">
            <strong>Current Phone Number:</strong>
            {{ $individual->current_phone_number}}
        </div>
    </div>
</div>


<div class="accordion" id="accordionExample">
    
    {{-- Accordion 1 --}}
    <div class="card">
        <div class="card-header" id="heading1">
            <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                Related Members (Same File Number)
            </button>
            </h2>
        </div>

        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
            <div class="card-body">
                <br>
                
                <!-- Individuals table -->
                @include('individuals.partials.file_individuals_table')                

            </div>
        </div>
    </div>
    {{-- End Accordion 1 --}}

    {{-- Accordion 3 --}}
    <div class="card">
        <div class="card-header" id="heading3">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    Referrals History
                </button>
            </h2>
        </div>
        <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordionExample">
        <div class="card-body">

            <br>
            @can('pss-case-list')
                {{-- add button --}}
                @can('pss-case-create')
                    <a href="{{route('psscases.create', ['id' => $individual->id])}}" class="btn btn-primary btn-sm mb-3" role="button" aria-pressed="true">
                        Add New Referral
                    </a>
                @endcan
                
                @if(!($individual->pssCases->isEmpty()))
                    <!-- Pss table -->
                    @include('individuals.partials.pss_cases')  
                @else
                    <div class="d-flex justify-content-center">There Are No Records</div>
                @endif


            @endcan

        </div>
    </div>
    {{-- End Accordion 3 --}}

</div>

<br><br><br>
<!-- row closed -->
@endsection
@section('js')

@endsection
