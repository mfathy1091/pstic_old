@if(!$individuals->isEmpty())
<!-- Table -->
<div class="table-responsive">
    <table id="datatable1" class="table table-hover table-sm table-bordered p-0"
        data-page-length="50"
        style="text-align: center">
        <thead>
            <tr>
                <th class="align-middle">File Number</th>               
                <th class="align-middle">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($individuals as $individual)
                <tr>
                    <td>{{ $individual->file->number }}
                    <td>{{ $individual->name }}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- End Table -->
@else
    <strong class="text-danger">This individual is not in the DB</strong>
    <br><br>
    <button class="btn btn-primary">Add Individual</button>
@endif