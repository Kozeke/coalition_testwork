<x-layout>
    <a href="{{route('task.index')}}">
        <h2>{{ __('Tasks') }}</h2></a>
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
        <form action="{{ route('task.update', ['task' => $task->id]) }}" method="POST"
              enctype="multipart/form-data">
            <div class="form-group">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <label for="name">{{ __('Name') }}</label>
            <input class="form-control"  id="name" name="name" type="text" required autofocus placeholder="Enter task name"
                   value="{{ $task->name }}"/>
            </div>
            <br>
            <div class="form-group">
            <label for="priority">{{ __('Priority') }}</label>
            <input class="form-control"  id="priority" name="priority" type="text" required autofocus placeholder="Enter priority number"
                   value="{{ $task->priority }}"/>
            </div>
            <br>
            <div class="form-group">
            <label for="project">Project</label>
            <select class="form-control"  id="project" name="project_id">
                @foreach($projects as $project)
                    <option
                        value="{{ $project->id }}"{{$project->id==$task->project_id?'selected':''}}>{{ $project->name }}</option>
                @endforeach
            </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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

