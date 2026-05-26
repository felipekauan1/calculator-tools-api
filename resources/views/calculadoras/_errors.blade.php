@if($errors->any())
    <div class="alert-errors">
        <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
            @foreach($errors->all() as $error)
                <li>⚠ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
