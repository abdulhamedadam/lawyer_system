<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class ZatcaTestController extends Controller
{
    public function registerDevice(Request $request)
    {
        $store = Store::first();

        $device = $store->registerZatcaDevice($request->otp, [
            'vat_no' => '300123456700003',
            'ci_no' => '1234567890',
            'company_name' => 'Test Company',
            'company_address' => 'Riyadh, KSA',
            'company_building' => '12A',
            'company_plot_identification' => '5678',
            'company_city_subdivision' => 'North Riyadh',
            'company_city' => 'Riyadh',
            'company_postal' => '12345',
            'company_country' => 'SA',
            'solution_name' => 'TestSolution',
            'common_name' => 'Test Common Name',
        ]);

        $device->active();

        return response()->json(['message' => 'Device registered successfully', 'device' => $device]);
    }
}
