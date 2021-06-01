@extends('.layouts.app')
<h1>GlobalRanking</h1>
@section('content')

<div class="container">
    <div id="vue-app">
        <score-list :scores="{{ $scores }}"></score-list>
    </div>
</div>

@endsection
