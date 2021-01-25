<?php

namespace App\Services;

use App\Events\OrderCreated;
use App\Models\Order;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderService extends Service
{
    /**
     * OrderService constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @param $order
     * @return Order
     * @throws Exception
     * @throws Throwable
     */
    public function store($order)
    {
        try {
            DB::beginTransaction();
            $item = $this->model->create($order);
            $item->products()->attach($order['products']);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            logger($e);
            throw $e;
        }
        OrderCreated::dispatch($item);

        return $item;
    }

    /**
     * @param $ip
     * @throws Exception
     */
    public function checkIP($ip)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://freegeoip.app/json/$ip",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new ConnectionException($err);
        } else {
            $data = json_decode($response);
            $list = config('blocklist');
        }

        if (in_array($data->country_code, $list)) {
            throw new ConnectionException('This service is not available in your country', 451);
        }
    }
}
