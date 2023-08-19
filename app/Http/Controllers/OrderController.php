<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Illuminate\Http\Request;
use DateTime;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $order = new Order;
        $order->title = $request->title;
        date_default_timezone_set("Europe/Moscow");

        $order->created_at = now();
        $order->updated_at = now();
        $order->status = 'created';
        $order->save();


        return redirect('/');
    }


    public function update(Request $request, Order $order)
    {
        $order->title = $request->title;
        date_default_timezone_set("Europe/Moscow");
        $order->updated_at = now();
        $order->save();

        return redirect('/');
    }

    public function confirm(Order $order)
    {
        if ($order->status == 'created') {
            $order->status = 'confirmed';
            date_default_timezone_set("Europe/Moscow");
            $order->updated_at = now();
            $order->save();
            Session::flash('flash_message', 'Заказ успешно подтвержден');
        } else if ($order->status == 'confirmed') {
            Session::flash('flash_message_cancel', 'Заказ уже подтвержден');
        } else {
            Session::flash('flash_message_cancel', 'Заказ уже завершен');
        }
        return redirect('/');
    }


    public function complete(Order $order)
    {
        if ($order->status != 'completed') {

            // Проверка прошла ли минута после создания заказа
            if ($this->canComplete($order)) {
                // Проверка вторая ли половина дня
                if ($this->isSecondHalfOfDay() && $order->status == 'confirmed') {
                    $order->status = 'completed';
                    date_default_timezone_set("Europe/Moscow");
                    $order->updated_at = now();
                    $order->save();
                    Session::flash('flash_message', 'Заказ успешно завершен');
                } elseif (!$this->isSecondHalfOfDay()) {
                    $order->status = 'completed';
                    date_default_timezone_set("Europe/Moscow");
                    $order->updated_at = now();
                    $order->save();
                    Session::flash('flash_message', 'Заказ успешно завершен');
                } else {
                    Session::flash('flash_message_cancel', 'Заказ должен быть подтвержден');
                }
            } else {
                Session::flash('flash_message_cancel', 'Заказ может быть завершен через минуту после его создания');
            }
        } else {
            Session::flash('flash_message_cancel', 'Заказ уже завершен');
        }

        return redirect('/');
    }


    private function canComplete($order)
    {
        $createdTime = $order->created_at;
        date_default_timezone_set("Europe/Moscow");
        // Преобразование даты создания в объект DateTime
        $createdAtDateTime = new DateTime($createdTime);
        // Добавление одной минуты к дате создания заказа
        $oneMinuteLater = $createdAtDateTime->modify('+1 minute');
        // Получение текущей даты и времени
        $currentDateTime = new DateTime();


        if ($currentDateTime >= $oneMinuteLater) {
            return true;
        }
        return false;
    }


    private function isSecondHalfOfDay()
    {
        date_default_timezone_set("Europe/Moscow");
        $now = now();
        $hour = $now->hour;
        //если время вторая половина дня
        if ($hour >= 12 && $hour <= 23) {
            return true;
        }
        return false;
    }


}
