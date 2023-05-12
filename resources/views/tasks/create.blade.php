<x-layout>
    <a href="{{route('task.index')}}">
        <h2>{{ __('Tasks') }}</h2></a>
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="name">{{ __('Name') }}</label>
                <input class="form-control" id="name" name="name" type="text" placeholder="Enter task name" required/>
            </div>
            <div class="form-group">
                <label for="priority">{{ __('Priority') }}</label>
                <input class="form-control" id="priority" name="priority" type="text"
                       placeholder="Enter priority number" required/>
            </div>
            <div class="form-group">
                <label for="project">{{ __('Project') }}</label>
                <select class="form-control" id="project" name="project_id">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <br>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <br>
            </div>
        </form>
    </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>

