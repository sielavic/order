<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дата изменения</th>
            <th scope="col">Статус</th>
            <th scope="col">Действия</th>
        </tr>
    </thead>
    <tbody>
@foreach($orders as $order)
    <tr>
        <th scope="row">{{ $order->id }}</th>
        <td>{{ $order->title }}</td>
        <td>{{ $order->created_at }}</td>
        <td>{{ $order->updated_at }}</td>
        <td>{{ $order->status }}</td>
        <td>
            <a href="/orders/{{ $order->id }}/edit">Редактировать</a>
            <a href="/orders/{{ $order->id }}/confirm">Подтвердить</a>
            <a href="/orders/{{ $order->id }}/complete">Завершить</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    @include('messages')
{{--    <button type="button"  onclick="editUpdate(<?= $news->id ?>);return false;" class="btn btn-success">Создать</button>--}}
    <a href="/orders/create" class="btn btn-success mt-4">Создать</a>

    </table>
