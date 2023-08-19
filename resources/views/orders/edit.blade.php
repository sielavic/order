<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<form method="post" action="/orders/{{ $order->id }}">
    <div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
        <div class="row justify-content-center">
            <div class="col text-center">
                @csrf
                @method('PUT')
                <input type="text" name="title" class="form-control" required="required" value="{{ $order->title }}">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>

        </div>
    </div>
</form>
