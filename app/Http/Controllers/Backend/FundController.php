<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facilities\FacilityPaymentMethod;
use App\Models\Fund;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\CardException;
use Yajra\DataTables\Facades\DataTables;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.funds.index'); //
    }


    public function dataTable(Request $request)
    {

        $model = Fund::with('transaction', 'payment_method');

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'isEdit' => false,
            'paymentMethods'=>FacilityPaymentMethod::whereStatus(1)->get()
        ];

        return view('backend.funds.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $user           = Auth::user();
        $paymentMethod  = FacilityPaymentMethod::find($request->payment_method);
        $stripPaymentID = $paymentMethod->stripe_payment_method_id;

        $amount = $request->payment_amount;

        DB::beginTransaction();

        try {

            $user->charge($amount * 100, $stripPaymentID, [
                'return_url' => route('backend.funds'),
            ]);

            $transaction = $user->wallet->depositFloat($amount);
            $transactionId = $transaction->id;

             Fund::create([
                'user_id'                    => $user->id,
                'transaction_id'             => $transactionId,
                'facility_payment_method_id' => $request->payment_method,
                'datetime'                   => now(),
                'amount'                     => $amount,
            ]);

            DB::commit();

            return redirect()->route('backend.funds')->with('success', 'Funds added successfully');

        } catch (CardException $e) {
            DB::rollBack();

            return redirect()->back()->with('error',  'Card was declined.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error',  $e->getMessage());
        }

        return redirect()->route('backend.funds')->with('success', 'Funds added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fund $fund)
    {
        $data = [
            'isEdit' => true,
            'paymentMethods'=>FacilityPaymentMethod::whereStatus(1)->get()
        ];

        return view('backend.funds.add', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fund $fund)
    {


        return redirect()->route('backend.funds')->with('success', 'funds updated successfully');
    }

    public function status(Request $request)
    {


        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $fund = Fund::find($request->id);

        $fund->delete();
        return response()->json(200);
    }
}
