<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


{{-- Benefits --}}
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h6>PSS Services</h6>
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
        
            <div class="table-responsive">
                <table id="benefits_table{{ $record->id }}" benefits[]={{ $record->benefits }} class="table table-hover table-sm table-bordered p-0"
                    data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>                            
                            <th>Beneficiary</th>
                            <th>Services Provided</th>
                        </tr>
                    </thead>
                    <tbody>

                            
                        @foreach($record->beneficiaries as $beneficiary)
                            <tr id="benefits_row" >
                                <td>{{ $beneficiary->individual->name }}</td>
                                <td id="benefits_cell">
                                    @if (!($beneficiary->benefits->isEmpty()))
                                        @foreach ($beneficiary->benefits as $benefit)                                            
                                            <div class="benefit_row{{$benefit -> id}}">
                                                {{ $benefit->service->name }}
                                                <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#delete_benefit{{ $benefit->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                                            </div>

                                            {{-- <button benefit_id="{{ $benefit->id }}" record_id="{{ $record->id }}" id="delete_btn" type="button" class="btn btn-danger btn-sm ml-5" title="Delete">Delete</i></button> --}}

                                            
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
                                    @else
                                        <div class="d-flex justify-content-center ml-3">N/A</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


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
                                <label for="beneficiary_id">Beneficiaries</label>
                                <select class="custom-select my-1 mr-sm-2" name="beneficiary_id">
                                    @foreach($record->beneficiaries as $beneficiary)
                                        <option value="{{$beneficiary->id}}">{{$beneficiary->individual->name}}</option>
                                    @endforeach
                                </select>
                                @error('beneficiary_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <label class="mr-sm-2">Services</label>
                        <div class="form-group border p-2">
                            @foreach($pssServices as $pssService)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="services_ids[]"
                                        value="{{ $pssService->id }}" id="{{ $pssService->name }}">
                                    <label class="form-check-label" for="{{ $pssService->name }}">{{ $pssService->name }}</label>
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


<script>
    $(document).on('click', '#delete_btn', function (e) {
        e.preventDefault();
            var benefit_id =  $(this).attr('benefit_id');
            var record_id =  $(this).attr('record_id');
            var benefits_table = document.querySelector('#benefits_table'+record_id);

            $.ajax({
            type: 'post',
            url: "{{route('benefits.delete')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id' :benefit_id
            },
            success: function (data) {
                if(data.status == true){
                    $('#success_msg').show();
                }
                // if(data.is_empty == true){
                //     $('#benefits_table'+record_id).hide();
                // }
                $('.benefit_row'+benefit_id).remove();

            }, error: function (reject) 
                {
                }
        });
    });
</script>