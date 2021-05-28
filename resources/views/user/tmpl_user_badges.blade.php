
<div class="badges">
    <h2>Badges</h2>
    <div class="d-flex flex-wrap">
        @foreach ($user->badges as $badge)
            <p class="p-2">{{ $badge->label }}</p>
        @endforeach
    </div>
</div>
