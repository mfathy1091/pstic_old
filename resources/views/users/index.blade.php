@extends('layouts.master')

@section('css')
@endsection

@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Users</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection

@section('content')


<div class="card">
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>


        
        {{-- add button --}}
        @can('user-create')
        <a href="{{route('users.create')}}" class="btn btn-primary btn" role="button"
        aria-pressed="true">Create User</a>
        @endcan

        <br><br>

        <div class="table-responsive">
            <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
            data-page-length="50"
            style="text-align: center">
                <thead>    
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Status</th>
                        <th>Roles</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th>Team</th>
                        <th>Budget</th>
                        <th>Last Login</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead >
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->status == '1')
                                <span class="badge badge-pill badge-success h-auto font-weight-bold font-italic">Enabled</span>
                            @elseif (($user->status == '0'))
                                <span class="badge badge-pill badge-danger h-auto font-weight-bold font-italic">Disabled</span>
                            @endif
                        </td>
                        <td>
                            @if($user->getRoleNames()->isNotEmpty())
                                @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-secondary">{{ $v }}</label>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{$user->jobTitle->name}}</td>
                        <td>{{$user->department->name}}</td>
                        <td>{{$user->team->name}}</td>
                        <td>{{$user->budget->name}}</td>
                        <td></td>
                        <td>
                            {{-- <a href="{{ route('users.show', $user->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a> --}}
                            <a href="{{ route('users.edit', $user->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_user{{ $user->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                        </td>


                    </tr>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="delete_user{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{route('users.destroy', $user->id)}}" method="post">
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
                                    <input type="hidden" name="id"  value="{{$user->id}}">
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
                    {{-- End Delete Modal --}}
                    @endforeach
                </tbody>
            </table>
    </div>
</div>



@endsection

@section('js')
@endsection
