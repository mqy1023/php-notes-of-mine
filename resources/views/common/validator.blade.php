<!-- 所有的错误提示 -->
@if (count($errors))
    <div class="alert alert-danger">
        <ul>
            <li>{{ $error->first() }}</li>
        </ul>
    </div>
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
