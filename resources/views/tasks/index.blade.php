<x-layout>
    <a href="{{route('project.index')}}">
        <h1>{{ __('Projects') }}</h1></a>
    <a href="{{route('task.index')}}">
        <h2>{{ __('Tasks') }}</h2></a>
    <a href="{{ route('task.create') }}">
        <button type="button" class="btn btn-success">{{ __('New') }}</button>
    </a>
    <table class="table">
        <tr>
            <td>Name</td>
            <td>Priority</td>
            <td>Project_id</td>
            <td>Created_at</td>
            <td></td>
            <td></td>
        </tr>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->name}}</td>
                <td>{{$task->priority}}</td>
                <td>{{$task->project_id}}</td>
                <td>{{$task->created_at}}</td>
                <td>
                    <a href="{{ route('task.edit', ['task' => $task->id]) }}">
                        <button type="button" class="btn btn-primary">Edit</button>
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('task.destroy', ['task' => $task->id]) }}" class="inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="button" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
    @endforeach
</x-layout>

