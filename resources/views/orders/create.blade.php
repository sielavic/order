<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<form method="post" action="/orders">
    <div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
        <div class="row justify-content-center">
            <div class="col text-center">
                @csrf
                <input type="text" name="title" required="required" class="form-control" placeholder="Название заказа">
            </div>
            <button type="submit" class="btn btn-success">Создать</button>

        </div>
    </div>

</form>
