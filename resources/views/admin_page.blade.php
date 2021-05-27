@extends('.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm d-flex flex-column add-badge">
                <h3 class="p2 text-center">Add Quiz</h3>
                <button type="button add-quiz" class="p2 btn btn-primary">Add Quiz</button>
            </div>
            <div class="col-sm d-flex flex-column add-badge">
                <h3 class="p2 text-center">Modify Quiz</h3>
                <button type="button mod-quiz" class="p2 btn btn-primary">Modify Quiz</button>
            </div>
            <div class="col-sm d-flex flex-column add-badge">
                <h3 class="p2 text-center">Add Badge</h3>
                <button type="button" class="p2 btn btn-primary">Add Badge</button>
            </div>
        </div>
    </div>
@endsection
