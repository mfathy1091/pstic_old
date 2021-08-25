<div class="table-responsive">
    <table id="datatable1" class="table  table-hover table-sm table-bordered p-0"
        data-page-length="50"
        style="text-align: center">
        <thead >
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Current Status</th>
                <th class="align-middle">Referral Date</th>
                <th class="align-middle">Referral Source</th>

                <th class="align-middle">Direct Beneficiary Name</th>
                <th class="align-middle">Age</th>
                <th class="align-middle">Gender</th>
                <th class="align-middle">Nationality</th>

                <th class="align-middle">Assigned PSW</th>

                <th class="align-middle">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            <?php $pssCases = $individual->pssCases; ?>

            @foreach ($pssCases as $pssCase)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>
                        @if ($pssCase->currentRecord->status->name == 'Inactive')
                            <span class="badge badge-pill badge-secondary h-auto font-weight-bold font-italic">{{ $pssCase->currentRecord->status->name }}</span>
                        @elseif ($pssCase->currentRecord->status->name == 'Active')
                            <span class="badge badge-pill badge-success h-auto font-weight-bold font-italic">{{ $pssCase->currentRecord->status->name }}</span>
                        @endif
                    </td>
                    <td>{{ $pssCase->referral->referral_date }}</td>
                    <td>{{ $pssCase->referral->referralSource->name }}</td>
                    
                    <td>{{ $pssCase->directIndividual->name }}</td>
                    <td>{{ $pssCase->directIndividual->age }}</td>
                    <td>{{ $pssCase->directIndividual->gender->name }}</td>
                    <td>{{ $pssCase->directIndividual->nationality->name }}</td>

                    <td>{{ $pssCase->assignedPsw->name }}</td>

                    <td>
                        <a href="{{route('psscases.show',$pssCase->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a>

                        <a href="{{route('psscases.edit',$pssCase->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_ps_case{{ $pssCase->id }}" title="Delete"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>



                <div class="modal fade" id="delete_ps_case{{$pssCase->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('psscases.destroy','test')}}" method="post">
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
                                <input type="hidden" name="id"  value="{{$pssCase->id}}">
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