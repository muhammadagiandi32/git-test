<?php

namespace App\Helpers;

use App\Models\SalesOrderHeader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KodeSo
{
    public static function KodeSalesOrder()
    {
        $latest =   DB::table('sales_order_headers')->orderBy('IdSoHeader', 'desc')->first();
        // return $latest;
        if (empty($latest)) {
            return "PO-" . date('dmy-') . "0001";
        } else {
            if (date('m', strtotime($latest->created_at)) != date('m', strtotime(now()))) {
                return "PO-" . date('dmy-') . "0001";
            } else {
                $NoSalesOrder = DB::table('sales_order_headers')->orderBy('IdSoHeader', 'desc')->first();
                $kode = Str::substr($NoSalesOrder->NoSalesOrder, 10) + 1;
                if (strlen($kode) == 1) {
                    return "PO-" . date('dmy-000') . $kode;
                } elseif (strlen($kode) == 2) {
                    return "PO-" . date('dmy-00') . $kode;
                } elseif (strlen($kode) == 3) {
                    return "PO-" . date('dmy-0') . $kode;
                } elseif (strlen($kode) == 4) {
                    return "PO-" . date('dmy-') . $kode;
                }
            }
        }
    }

    // buat NO Delivery
    public static function KodeDeliveryOrder()
    {
        $NoDeliveryOrder =   DB::table('delivery_orders_header')->orderBy('IdDoHeader', 'desc')->first();
        if (empty($NoDeliveryOrder)) {
            return "DO-" . date('dmy-') . "0001";
        } else {
            if (date('m', strtotime($NoDeliveryOrder->created_at)) != date('m', strtotime(now()))) {
                return "DO-" . date('dmy-') . "0001";
            } else {
                // $NoDeliveryOrder = DB::table('sales_order_headers')->orderBy('IdSoHeader', 'desc')->first();
                $kode = Str::substr($NoDeliveryOrder->NoSalesOrder, 10) + 1;
                if (strlen($kode) == 1) {
                    return "DO-" . date('dmy-000') . $kode;
                } elseif (strlen($kode) == 2) {
                    return "DO-" . date('dmy-00') . $kode;
                } elseif (strlen($kode) == 3) {
                    return "DO-" . date('dmy-0') . $kode;
                } elseif (strlen($kode) == 4) {
                    return "DO-" . date('dmy-') . $kode;
                }
            }
        }
    }

    // buat no Invoice
}
