<x-layout>
    <a href="{{route('project.index')}}">
        <h2>{{ __('Projects') }}</h2></a>
    <div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2">

                <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">

                        {{ csrf_field() }}
                        <label for="name">{{ __('Name') }}</label>
                        <input class="form-control" id="name" name="name" type="text" required
                               placeholder="Enter project name"/>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <br>
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

