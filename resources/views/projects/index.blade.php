<x-layout>
    <a href="{{route('project.index')}}">
        <h2>{{ __('Projects') }}</h2></a>
    <a href="{{ route('project.create') }}">
        <button type="submit" class="btn btn-primary">{{ __('New Project') }}</button>
    </a>
    <a href="{{ route('task.create')}}">
        <button type="submit" class="btn btn-secondary">{{ __('New Task') }}</button>
    </a>
    <br>
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
    <div class="form-group">
    <label for="project">Project </label><select class="form-control"  id="project" name="project" onchange="return showcategory();">
        <option value="">Select Project</option>
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
    </div>
        </div>

    @foreach($projects as $project)
        <div id="project{{$project->id}}" class="tasks" style="visibility: hidden">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>Priority</td>
                    <td>Created_at</td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($project->tasks as $task)
                    <tr>
                        <td>{{$task->name}}</td>
                        <td>{{$task->priority}}</td>
                        <td>{{$task->created_at}}</td>
                        <td><a href="{{ route('task.edit', ['task' => $task->id]) }}">
                                <button type="button" class="btn btn-warning">Edit</button>
                            </a></td>
                        <td>
                            <form method="post" action="{{ route('task.destroy', ['task' => $task->id]) }}"
                                  class="inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="button" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach


</x-layout>

<script>
    function showcategory() {
        var tasks = document.querySelectorAll('.tasks');
        tasks.forEach(task => task.style.visibility = 'hidden');
        var selectBox = document.getElementById('project');
        var userInput = selectBox.options[selectBox.selectedIndex].value;
        console.log(userInput);
        id = 'project' + userInput;
        document.getElementById(id).style.visibility = 'visible';
        return false;
    }
</script>
