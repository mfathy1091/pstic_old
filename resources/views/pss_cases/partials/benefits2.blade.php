{{-- Benefits --}}
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h6>PSS Benefits</h6>
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addServiceModal{{ $record->id }}">
                Add
            </button>                                      
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if (!($record->benefits->isEmpty()))
            <div class="table-responsive">
                <table id="datatable1" class="table table-hover table-sm table-bordered p-0"
                    data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>Benefit</th>                            
                            <th>Beneficiaries</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($record->beneficiaries as $beneficiary)
                            @if (!($beneficiary->benefits->isEmpty()))
                                <tr>
                                    <td>{{ $beneficiary->individual->name }}</td>
                                    <td>
                                        @foreach ($beneficiary->benefits as $benefit)                                            
                                            <div>
                                                {{ $benefit->service->name }}
                                                <button type="button" class="btn btn-danger btn-sm ml-5" data-toggle="modal" data-target="#benefit{{ $benefit->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                            </div>

                                            {{-- Delete Modal --}}
                                            <div class="modal fade" id="delete_benefit{{$benefit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('benefits.destroy', $benefit->id)}}" method="post">
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
                                                            <input type="hidden" name="id"  value="{{$benefit->id}}">
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
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="d-flex justify-content-left ml-3">There Are No Records</div>
        @endif

    </div>
    
</div>


<!-- ADD Benefit MODAL -->
<div class="modal fade" id="addServiceModal{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Add Benefit
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('benefits.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="pss_case_id" value="{{ $pssCase->id }}">
                        <input type="hidden" name="record_id" value="{{ $record->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="service_id">Service</label>
                                <select class="custom-select my-1 mr-sm-2" name="service_id">
                                    <option selected>Select Service</option>
                                    @foreach($pssServices as $pssService)
                                        <option value="{{$pssService->id}}">{{$pssService->name}}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
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
    <!-- End Add Benefit Modal -->