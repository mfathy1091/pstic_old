@extends('layouts.master')

@section('css')
@endsection

@section('page-header')

		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="left-content">
				<div>
					<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Roles</h2>
				</div>
			</div>
			<div class="main-dashboard-header-right">

			</div>
		</div>
		<!-- /breadcrumb -->
@endsection

@section('content')

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
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


        
        {{-- add button --}}
        @can('role-create')
        <a href="{{route('roles.create')}}" class="btn btn-primary btn" role="button"
        aria-pressed="true">Create Role</a>
        @endcan

        <br><br>

        <div class="table-responsive">
            <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
            data-page-length="50"
            style="text-align: center">
                <thead>   
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>    
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td class="align-middle">{{ ++$i }}</td>
                        <td class="align-middle">{{ $role->name }}</td>
                        <td class="align-middle">
                            @foreach ($role->getPermissionNames() as $permission)
                                {{ $permission }}
                                <br>
                            @endforeach
                        </td>
                        <td class="align-middle">
                            {{-- <a href="{{ route('roles.show', $role->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a> --}}
                            @can('role-edit')
                                <a href="{{ route('roles.edit', $role->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('role-delete')
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_role{{ $role->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                            @endcan
                        </td>
                    </tr>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="delete_role{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{route('roles.destroy', $role->id)}}" method="post">
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
                                    <input type="hidden" name="id"  value="{{$role->id}}">
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
</div>

{!! $roles->render() !!}


@endsection

@section('js')

@endsection
