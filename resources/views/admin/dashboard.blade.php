@extends('.admin.template')
<h1>Dashboard Admin Pro League</h1>

@section('content')

<a href="/admin/quiz" class="btn btn-secondary" >Quizzes</a>
<a href="/admin/badge" class="btn btn-secondary">Badges</a>
<a href="/admin/user" class="btn btn-secondary" >Users</a>

<div class="btn-group pull-right">
    <a href='/home' class='btn btn-primary'>Public dashboard</a>
</div>
@endsection


