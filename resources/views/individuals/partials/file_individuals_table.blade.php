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
        <tbody>
            <?php $individuals = $individual->file->individuals; ?>
            @foreach ($individuals as $individual)
                <tr>
                    <td>{{ $individual->file->number }}
                    <td>{{ $individual->individual_id }}
                    <td>{{ $individual->passport_number }}
                    <td>{{ $individual->name }}
                    <td>{{ $individual->native_name }}
                    <td>{{ $individual->relationship->name }}
                    <td>{{ $individual->age }}</td>
                    <td>{{ $individual->gender->name }}</td>
                    <td>{{ $individual->nationality->name }}</td>
                    <td>{{ $individual->current_phone_number }}</td>
                    <td>
                        <a href="{{route('individuals.show', $individual->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>