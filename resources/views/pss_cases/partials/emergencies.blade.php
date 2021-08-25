{{-- Benefits --}}
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h6>PSS Emergency</h6>
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addEmergencyModal{{ $record->id }}">
                Add
            </button>                                      
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        @if(!$record->emergencies->isEmpty())

            <div class="table-responsive">
                <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
                    data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th class="align-left">Type</th> 
                            <th class="align-left">Date</th>                                                      
                            <th class="align-left">Comment</th>
                            <th class="align-left">Beneficaries</th> 
                            <th class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($record->emergencies as $emergency)
                            <tr>
                                <td>{{ $emergency->emergencyType->name }}</td>
                                <td>{{ $emergency->emergency_date }}</td>
                                <td>{{ $emergency->comment }}</td>
                                <td>
                                    @foreach ($emergency->beneficiaries as $beneficiary)
                                        <div>
                                            {{ $beneficiary->individual->name }}
                                        </div>
                                    @endforeach
                                </td>
                                <td>        
                                    {{-- <a href="{{route('emergencies.edit', $emergency->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a> --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_emergency{{ $emergency->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="delete_emergency{{ $emergency->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('emergencies.destroy', $emergency->id)}}" method="post">
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
                                            <input type="hidden" name="id"  value="{{$emergency->id}}">
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

<!-- ADD Emergency MODAL -->
<div class="modal fade" id="addEmergencyModal{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Add Emergency
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('emergencies.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="pss_case_id" value="{{ $pssCase->id }}">
                        <input type="hidden" name="record_id" value="{{ $record->id }}">
                        <input type="hidden" name="beneficiary_id" value="{{ $record->directBeneficiary->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="service_id">Emergency Type</label>
                                <select class="custom-select my-1 mr-sm-2" name="emergency_type_id">
                                    @foreach($emergencyTypes as $emergencyType)
                                        <option value="{{$emergencyType->id}}">{{$emergencyType->name}}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
{{--                         <label class="mr-sm-2">Emegency Types</label>
                        <div class="form-group border p-2">
                            @foreach($emergenciesTypes as $emergencyType)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="emergency_types_ids[]"
                                        value="{{ $emergencyType->id }}" id="{{ $emergencyType->name }}">
                                    <label class="form-check-label" for="{{ $emergencyType->name }}">{{ $emergencyType->name }}</label>
                                </div>
                            @endforeach
                        </div> --}}

                        <label for="beneficiaries_ids" class="mr-sm-2">Beneficiaries</label>
                        <div class="form-group border p-2">
                            @foreach($record->beneficiaries as $beneficiary)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="beneficiaries_ids[]"
                                        value="{{ $beneficiary->id }}" id="{{ $beneficiary->name }}">
                                    <label class="form-check-label" for="{{ $beneficiary->name }}">{{ $beneficiary->individual->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="emergency_date">Emergency Date</label>
                            <div class='input-group date'>
                                <input id="emergency_date" name="emergency_date" class="form-control fc-datepicker" placeholder="DD/MM/YYYY" type="text" autocomplete="off" required>
                            </div>
                            @error('emergency_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>             

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" rows="3" name="comment" ></textarea>
                        </div>



                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Add Emergency Modal -->