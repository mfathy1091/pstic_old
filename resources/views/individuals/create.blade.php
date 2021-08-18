@extends('layouts.master')

@section('css')
@endsection

@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Add Individual</h2>
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
                <form action="{{route('individuals.store')}}" method="post">
                @csrf

                    <input type="hidden" id="file_id" name="file_id" value="{{ $file->id }}">

                    <div class="form-group">
                        <input type="checkbox" aria-label="Radio button for following text input">
                        <label for="individual_id" class="mr-sm-2 text-danger">UNREGISTERED?</label>
                    </div>


                    <div class="form-group">
                        <label for="file_number" class="mr-sm-2">File Number</label>
                        <input id="file_number" type="text" name="file_number" class="form-control">
                        @error('file_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="individual_id" class="mr-sm-2">Individual ID</label>
                        <input id="individual_id" type="text" name="individual_id" class="form-control">
                        @error('individual_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="passport_number" class="mr-sm-2">Passport ID</label>
                        <input id="passport_number" type="text" name="passport_number" class="form-control">
                        @error('passport_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="mr-sm-2">Name</label>
                        <input id="name" type="text" name="name" class="form-control">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="native_name" class="mr-sm-2">Native Name</label>
                        <input id="native_name" type="text" name="native_name" class="form-control">
                        @error('native_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="age" class="mr-sm-2">Age</label>
                        <input id="age" type="number" name="age" class="form-control">
                        @error('age')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="inputState">Gender</label>
                        <select class="custom-select my-1 mr-sm-2" name="gender_id">
                            <option selected disabled>Choose...</option>
                            @foreach($genders as $gender)
                                <option value="{{$gender->id}}">{{$gender->name}}</option>
                            @endforeach
                        </select>
                        @error('gender_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputCity">Nationality</label>
                        <select class="custom-select my-1 mr-sm-2" name="nationality_id">
                            <option selected disabled>Choose...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('nationality_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputCity">Relationship to PA</label>
                        <select class="custom-select my-1 mr-sm-2" name="relationship_id">
                            <option selected disabled>Choose...</option>
                            @foreach($relationships as $relationship)
                                <option value="{{$relationship->id}}">{{$relationship->name}}</option>
                            @endforeach
                        </select>
                        @error('relationship_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="current_phone_number" class="mr-sm-2">Current Phone Number</label>
                        <input id="current_phone_number" type="text" name="current_phone_number" class="form-control">
                        @error('current_phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
@endsection
