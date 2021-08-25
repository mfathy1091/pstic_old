{{-- Beneficiaries --}}
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h6>PSS Beneficiaries</h6>
        </div>
        <div class="pull-right">
            {{-- <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addBeneficiaryModal{{ $record->id }}">
                Add
            </button>                                                  --}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if(!$record->beneficiaries->isEmpty())

            <div class="table-responsive">
                <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
                    data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>                            
                            <th class="align-middle">Name</th>
                            <th class="align-middle">Age</th>
                            <th class="align-middle">Gender</th>
                            <th class="align-middle">Nationality</th>
                            {{-- <th class="align-middle">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($record->beneficiaries as $beneficiary)
                            <tr>
                                <td>
                                    {{ $beneficiary->individual->name }}
                                    @if ($beneficiary->is_direct === '1')
                                        <span class="badge badge-pill badge-secondary ml-4 font-weight-bold font-italic">Direct</span>
                                    @endif
                                </td>
                                <td>{{ $beneficiary->individual->age }}</td>
                                <td>{{ $beneficiary->individual->gender->name }}</td>
                                <td>{{ $beneficiary->individual->nationality->name }}</td>
                                {{-- <td>        
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_beneficiary{{ $beneficiary->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                </td> --}}
                            </tr>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="delete_beneficiary{{ $beneficiary->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('beneficiaries.destroy', $beneficiary->id)}}" method="post">
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
                                            <input type="hidden" name="id"  value="{{$beneficiary->id}}">
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
        @else
        <div class="d-flex justify-content-left ml-3">There Are No Records</div>
        @endif
    </div>
    
</div>






