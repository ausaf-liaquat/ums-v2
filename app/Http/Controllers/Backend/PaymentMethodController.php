<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facilities\FacilityPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return view('backend.payment-methods.index');
    }

    public function dataTable(Request $request)
    {

        $model = FacilityPaymentMethod::query()->where('facility_id', auth()->user()->facility->id);

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request)
    {

        $data = [
            'isEdit' => false,
            // 'colors' => MFColor::whereStatus(1)->get(),
            // 'sizes'  => MFSize::whereStatus(1)->get(),
            // 'types'  => DB::table('mf_types')->get(),
        ];

        return view('backend.payment-methods.add', $data);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $paymentMethod = $request->paymentMethod;
        $cardType = $request->cardType;
        $cardNumber = $request->cardNumber;
        try {
            $user->updateDefaultPaymentMethod($paymentMethod);
            $payment_method = FacilityPaymentMethod::create([
                'facility_id'              => auth()->user()->facility->id,
                'stripe_payment_method_id' => $paymentMethod,
                'first'                    => $request->cardHolderName,
                'card_type'                => $cardType,
                'card_number'              => $cardNumber,
            ]);
            return response()->json(['success' => true, 'redirect_url' => route('backend.payment-methods')]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // return redirect()->route('backend.payment-methods')->with('success', 'Payment method added successfully');
    }

    public function edit(FacilityPaymentMethod $payment_method)
    {

        $data = [
            'isEdit'  => true,
            'payment_method' => $payment_method,
        ];

        return view('backend.payment-methods.add', $data);
    }

    public function update(Request $request, FacilityPaymentMethod $payment_method)
    {

        $payment_method->update([
            'facility_id'       => auth()->user()->facility->id,
            'bank_name'         => $request->bank_name,
            'routing_number'    => $request->routing_number,
            'account_number'    => $request->account_number,
            'first'             => $request->first,
            'middle'            => $request->middle,
            'last'              => $request->last,
            'card_type'         => $request->card_type,
            'card_number'       => $request->card_number,
            'exp_month'         => $request->exp_month,
            'exp_year'          => $request->exp_year,
            'security_code'     => $request->security_code,
            'billing_address_1' => $request->billing_address_1,
            'billing_address_2' => $request->billing_address_2,
            'city_id'           => $request->city_id,
            'state_id'          => $request->state_id,
            'country_id'        => $request->country_id,
            'zip_code'          => $request->zip_code,
        ]);


        return redirect()->route('backend.payment-methods')->with('success', 'Payment method updated successfully');
    }
    public function status(Request $request)
    {

        $payment_method = FacilityPaymentMethod::find($request->id);

        $payment_method->update([
            'status' => $request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $payment_method = FacilityPaymentMethod::find($request->id);

        $payment_method->delete();
        return response()->json(200);
    }
}
