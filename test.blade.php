{{-- relatedbeneficiaries --}}
<div class="form-group">
    <label for="file_number" class="mr-sm-2">File Number</label>
    <input id="file_number" type="text" name="file_number" class="form-control" value="{{ $individual->file->number }}">
</div>

<div class="form-group">
    <label for="beneficiaries" class="mr-sm-2">Beneficiaries related to same file number:</label>
    <div>
        <select class="form-select" multiple aria-label="beneficiaries" name="beneficiaries[]">
            <?php $individuals = $individual->file->individuals; ?>
            @foreach ($individuals as $individual)
                <option value="{{ $individual->id }}">{{ $individual->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- is emergency checkbox -->
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Yes" id="flexCheckDefault" name="is_emergency">
        <label class="form-check-label" for="flexCheckDefault">
            Emergency
        </label>
    </div>
</div>




<!-- ADD Beneficiary MODAL to a Record-->
<div class="modal fade" id="addBeneficiaryModal{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Add Beneficiary
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('beneficiaries.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="record_id" value="{{ $record->id }}">

                        <div class="form-group">
                            <label for="direct_individual_name" class="mr-sm-2">Direct Beneficiary</label>
                            <input id="direct_individual_name" type="text" name="direct_individual_name" class="form-control" value="{{ $individual->name }}">
                        </div>
    
                        {{-- <div class="form-group">
                            <label for="file_number" class="mr-sm-2">File Number</label>
                            <input id="file_number" type="text" name="file_number" class="form-control" value="{{ $individual->file->number }}">
                        </div>
                            
                        <div class="form-group">
                            <label for="beneficiaries" class="mr-sm-2">Beneficiaries related to same file number:</label>
                            <div>
                                <select class="form-select" multiple aria-label="beneficiaries" name="beneficiaries[]">
                                    <?php $individuals = $individual->file->individuals; ?>
                                    @foreach ($individuals as $individual)
                                        <option value="{{ $individual->id }}">{{ $individual->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

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
    <!-- End Add Beneficiary Modal -->



 <!-- back button -->
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>



    {{-- select menue --}}
    <select class="custom-select my-1 mr-sm-2" name="budget_id">
        @if(isset($user))
            <option disabled>Choose...</option>
            @foreach($budgets as $budget)
                <option value="{{$budget->id}}">{{$budget->name}}</option>
            @endforeach
        @else
            <option disabled selected>Choose...</option>
            @foreach($budgets as $budget)
                <option value="{{$budget->id}}"
                    @isset($user)
                        @if ($user->budget->name == $budget->name)
                            selected 
                        @endif
                    @endisset>{{$budget->name}}</option>
            @endforeach
        @endif
    </select>