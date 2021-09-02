
@extends('layouts.master')

@section('css')
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

        {{-- <check-individual></check-individual> --}}

        {{-- <autocomplete-component></autocomplete-component> --}}
        
        <div class="card">

            <div class="card-body">
                {{-- <trip-form></trip-form> --}}
                {{-- <multi_step-form></multi_step-form> --}}
                <add-individual></add-individual>
                <login-form></login-form>
            </div>
        </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection




