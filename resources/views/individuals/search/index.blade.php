@extends('layouts.master')
@section('css')
@endsection
@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Search Individuals</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection

@section('content')
        

		


        <!-- Individual Search-->
        <div class="card col-12">
            <div class="card-body">
                <h5 class="card-title">Individual Search</h5>
                <p class="text-muted">Hint: You can search using part of the number</p>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <input class="form-control" id="file_number" name="file_number" type="search" placeholder="File Number" aria-label="File Number">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <input class="form-control" id="individual_id" name="individual_id" type="search" placeholder="Individual ID" aria-label="Individual ID">
                        </div>
                        <div class="col-sm-6 mb-2">
                            <input class="form-control" id="passport_number" name="passport_number" type="search" placeholder="Passport Number" aria-label="File Number">
                        </div>
                    </div>

                    <button id="search_btn" class="btn btn-primary my-2 my-sm-2">Search</button>
                </form>
                
                <div id="results_outer_container">
                    <hr>
                    <h5 class="align-center">Total Data: <span id="total_records"></span></h5>
                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="datatable1" class="table table-hover table-sm table-bordered p-0"
                            data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="align-middle">File Number</th>
                                    <th class="align-middle">Individual ID</th>
                                    <th class="align-middle">Individual Passport #</th>                     
                                    <th class="align-middle">Name</th>
                                    <th class="align-middle">Native Name</th>
                                    <th class="align-middle">Relationship</th>
                                    <th class="align-middle">Age</th>
                                    <th class="align-middle">Gender</th>
                                    <th class="align-middle">Nationality</th>
                                    <th class="align-middle">Current Phone #</th>
                                    <th class="align-middle">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="rows_container">
                                {{-- place for search results --}}
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->
                </div>
            </div>
        
            

        </div>
        
        


				



@endsection
@section('js')
<script>
    $(document).ready(function()
    {
        $("#results_outer_container").hide();

        function fetch_data(file_number = '', individual_id = '', passport_number = '')
        {
            $.ajax({
                url: "{{ route('individuals.search.action') }}",
                method: 'GET',
                data: {
                    file_number:file_number,
                    individual_id:individual_id,
                    passport_number:passport_number,
                },
                dataType: 'json',
                success:function(data){
                    $('#results_outer_container').show();
                    $('#rows_container').html(data.record_rows);
                    $('#total_records').html(data.total_records);
                }
            });
        }


        
        $(document).on('click', '#search_btn', function(e) {
            e.preventDefault();
            var file_number = $('#file_number').val();
            var individual_id = $('#individual_id').val();
            var passport_number = $('#passport_number').val();
            fetch_data(file_number, individual_id, passport_number);
        });

    });
    
    </script>
@endsection