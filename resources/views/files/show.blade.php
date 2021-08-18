@extends('layouts.master')

@section('css')
@endsection

@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">File Number Details - {{ $file->number }}</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection

@section('content')
<!-- row -->
    
<div class="card">
    <div class="card-body">
        
        {{-- add button --}}
        @can('individual-create')
            <a href="{{route('individuals.create', [$file->id])}}" class="btn btn-primary btn mb-3" role="button" aria-pressed="true">
                Add Individual to {{ $file->number }}
            </a>
        @endcan

        <!-- individuals table -->
        @include('files.partials.individuals_table')

    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection




{{-- <!-- Referrals tab pane-->
<div class="tab-pane fade" id="referrals" role="tabpanel" aria-labelledby="referrals-tab">
    <?php $referrals = $file->referrals; ?>
    @foreach ($referrals as $referral)
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h6 class="text-primary">
                            {{ $referral->referralSource->name }} <span class="text-muted ml-2 mr-2">|</span> {{ $referral->referral_date }}
                        </h6>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary float-right">Add Section</button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <?php $sections = $referral->sections; ?>
                    

                    <div class="table-responsive">
                        <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
                            data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>                        
                                    <th class="align-middle">Section</th>
                                    <th class="align-middle">Assigned Worker</th>
                                    <th class="align-middle">Direct individual</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $referrals = $file->referrals; ?>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section->name }} <span class="badge badge-primary">{{ $section->pivot->currentStatus->name }}</span></td>
                                        <td>{{ $section->pivot->assignedWorker->name }}</td>
                                        <td>{{ $section->pivot->directindividual->name }}</td>
                                        <td>
                                            <a href="{{route('pss.show',$referral->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a>
                    
                                            <a href="{{route('pscases.allcases.edit',$referral->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_ps_case{{ $referral->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                    
                                    <div class="modal fade" id="delete_member{{$individual->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="" method="post">
                                                {{method_field('delete')}}
                                                {{csrf_field()}}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>'Are You Sure?'</p>
                                                    <input type="hidden" name="id"  value="{{$individual->id}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div>


            </div>
        </div>
    </div>

    @endforeach


</div> --}}