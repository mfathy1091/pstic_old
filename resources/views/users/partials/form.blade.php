
@csrf

<div class="form-group">
    <label for="name" class="mr-sm-2">Name</label>
    <input id="name" type="text" required autocomplete="name" autofocus name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') }}@isset($user){{ $user->name }} @endisset">
    
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="email" class="mr-sm-2">E-mail Address</label>
    <input id="email" type="email" name="email" required autocomplete="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}@isset($user){{ $user->email }} @endisset">

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@isset($create)
    <div class="form-group">
        <label for="password" class="mr-sm-2">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endisset

<div class="form-group">
    <label for="department_id">Department</label>
    <select class="custom-select my-1 mr-sm-2" name="department_id">
        @if(isset($user))
            <option disabled>Choose...</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}"@if($user->department->name == $department->name) selected @endif>{{$department->name}}</option>    
            @endforeach
        @else
            <option disabled selected>Choose...</option>
            @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        @endif
    </select>
    @error('department_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="team_id">Team</label>
    <select class="custom-select my-1 mr-sm-2" name="team_id">
        @if(isset($user))
            <option disabled>Choose...</option>
            @foreach($teams as $team)
                <option value="{{$team->id}}"@if($user->team->name == $team->name) selected @endif>{{$team->name}}</option>    
            @endforeach
        @else
            <option disabled selected>Choose...</option>
            @foreach($teams as $team)
                <option value="{{$team->id}}">{{$team->name}}</option>
            @endforeach
        @endif
    </select>
    @error('team_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="job_title_id">Job Title</label>
    <select class="custom-select my-1 mr-sm-2" name="job_title_id">
        @if(isset($user))
            <option disabled>Choose...</option>
            @foreach($jobTitles as $jobTitle)
                <option value="{{$jobTitle->id}}"@if($user->jobTitle->name == $jobTitle->name) selected @endif>{{$jobTitle->name}}</option>    
            @endforeach
        @else
            <option disabled selected>Choose...</option>
            @foreach($jobTitles as $jobTitle)
                <option value="{{$jobTitle->id}}">{{$jobTitle->name}}</option>
            @endforeach
        @endif
    </select>
    @error('job_title_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="budget_id">Budget</label>
    <select class="custom-select my-1 mr-sm-2" name="budget_id">
        @if(isset($user))
            <option disabled>Choose...</option>
            @foreach($budgets as $budget)
                <option value="{{$budget->id}}"@if($user->budget->name == $budget->name) selected @endif>{{$budget->name}}</option>    
            @endforeach
        @else
            <option disabled selected>Choose...</option>
            @foreach($budgets as $budget)
                <option value="{{$budget->id}}">{{$budget->name}}</option>
            @endforeach
        @endif
    </select>
    @error('budget_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<label class="mr-sm-2">Roles (Access Levels)</label>
<div class="form-group border p-2">
    @foreach ($roles as $role)
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="roles[]"
                value="{{ $role->id }}" id="{{ $role->name }}"
                @isset($user)
                    @if(in_array($role->id, $user->roles->pluck('id')->toArray()))
                        checked 
                    @endif
                @endisset>
            <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
        </div>
    @endforeach
</div>

<br>
<div class="form-group p-2">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Yes" id="status" name="status" 
            @isset($user)
                @if ($user->status == 1)
                    checked
                @endif
            @endisset
        >
        <label class="form-check-label" for="status">
            Activate Account?
        </label>
    </div>
</div>

<br>

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">Create</button>
</div>