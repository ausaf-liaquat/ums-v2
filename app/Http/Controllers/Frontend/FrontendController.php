<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Courses\Course;
use App\Models\Courses\CourseSchedule;
use App\Models\Courses\CourseUserSchedule;
use App\Models\Order;
use App\Models\TalkToUs;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class FrontendController extends Controller
{
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        
         // Sample input variables
    $member_id = 1;
    $payment = 800;
    $discount = 100;

    // Sample data for testing
    $members = [
        1 => [
            'id' => 1, 'name' => 'John Doe', 'is_onetime_paid' => 0,
            'fee_voucher' => [
                ['id' => 101, 'status' => 0, 'voucher_details' => [
                    ['id' => 201, 'amount' => 500, 'mf_fees_type_id' => 1, 'month' => 'Jan'],
                    ['id' => 202, 'amount' => 300, 'mf_fees_type_id' => 2, 'month' => 'Feb']
                ], 'voucher_payment_details' => []]
            ]
        ]
    ];

    $feeVoucherPayments = [];
    $feeVoucherPaymentDetails = [];
    $totalPaidAmount = 0;
    $checkIsAdmissionPaid = false;

    // Simulating getting member data
    $member = $members[$member_id] ?? null;
    if (!$member) return ['error' => 'Member not found'];

    foreach ($member['fee_voucher'] as $voucher) {
        foreach ($voucher['voucher_details'] as $detail) {
            $amountToPay = min($detail['amount'], $payment);
            $totalPaidAmount += $amountToPay;
            $payment -= $amountToPay;

            $feeVoucherPaymentDetails[] = [
                'fee_voucher_id' => $voucher['id'],
                'member_id' => $member_id,
                'mf_fees_type_id' => $detail['mf_fees_type_id'],
                'month' => $detail['month'],
                'amount' => $amountToPay
            ];

            if ($detail['mf_fees_type_id'] == 1) { // Assuming 1 is admission fee
                $checkIsAdmissionPaid = true;
            }
        }
    }

    $feeVoucherPayments[] = [
        'member_id' => $member_id,
        'received_by_id' => 1, // Dummy received by
        'amount' => $totalPaidAmount,
        'discount' => $discount
    ];

    // Updating member is_onetime_paid status
    if ($checkIsAdmissionPaid) {
        $members[$member_id]['is_onetime_paid'] = 1;
    }

    $data= [
        'feeVoucherPayments' => $feeVoucherPayments,
        'feeVoucherPaymentDetails' => $feeVoucherPaymentDetails,
        'updatedMembers' => $members
    ];

    dd($data);
        return view('frontend.index');
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function services()
    {
        return view('frontend.services');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function aboutUs()
    {
        return view('frontend.about-us');
    }
    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function joinOurTeam()
    {
        return view('frontend.join-our-team');
    }
    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function talkToUs()
    {
        return view('frontend.talk-to-us');
    }

    public function talkToUsStore(Request $request)
    {
        TalkToUs::create($request->all());
        return redirect()->back()->with('status', "Form Submitted Successfully");
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function careers()
    {
        return view('frontend.careers');
    }
    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function contactUs()
    {
        return view('frontend.contact-us');
    }
    public function contactUsStore(Request $request)
    {
        // $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'contact_us');
        // dd($score);
         // Step 1: Validate Input

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_no' => 'required|numeric|digits_between:10,15',
            'type' => 'required|in:Staffing,Online Course,Medical Supplies,Medical Uniforms,Medical coding and billing',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required|recaptchav3:contact_us,0.9',
            'honey_pot' => 'nullable|string|max:0', // HoneyPot should be empty
        ]);

        // Step 2: Check for HoneyPot Field (Spam Detection)
        if ($request->filled('honey_pot')) {
            return redirect()->back()->with('error', 'Suspicious activity detected.');
        }

        try {
            // Step 3: Store Data in Database
            DB::table('contact_us')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'message' => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Step 4: Send Email Notification
            Mail::to('info@uniquemedsvcs.com')->send(
                new ContactMail(
                    $request->type,
                    $request->message,
                    $request->phone,
                    $request->email,
                    $request->name
                )
            );

            // Step 5: Return Success Response
            return redirect()->back()->with('success', 'Form has been submitted successfully');
        } catch (\Exception $e) {
            // Step 6: Handle Exceptions Gracefully
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }

    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function courses()
    {
        $data = [
            'courses' => Course::whereStatus(1)->get(),
        ];
        return view('frontend.course', $data);
    }

    public function courseRegister($slug, Request $request)
    {

        $course = Course::whereSlug($slug)->first();
        if (auth()->check()) {
            if (auth()->user()->hasRole('super admin') || auth()->user()->hasRole('facility')) {
                session()->flush();
                auth()->logout();
            }
        }
        $databaseDates = CourseSchedule::where('course_id', $course->id)->pluck('datetime')->map(function ($datetime) {
            return Carbon::parse($datetime)->format('Y-m-d');
        })->toArray();
        if ($course->type == 1) {
            return view('frontend.course-checkout', compact('course'));
        } else {
            return view('frontend.course-register', compact('course', 'databaseDates'));
        }
    }

    public function courseCheckout($slug, CourseSchedule $course_schedule, Request $request)
    {
        $course = Course::whereSlug($request->slug)->first();
        $event = $course_schedule;
        return view('frontend.course-checkout', compact('course', 'event'));
    }
    public function checkoutStore(Request $request)
    {

        // Store the extracted fields in the session

        if (auth()->check()) {
            session()->put([
                'date' => $request->date,
                'cid' => $request->cid,
                'course_schedule_id' => $request->course_schedule_id,
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
                'user_id' => auth()->user()->id,
                'file' => $request->file,
            ]);
        } else {

            session()->put($request->only([
                'date', 'cid', 'first_name', 'last_name', 'email', 'phone', 'message', 'file', 'course_schedule_id',
            ]));

            // dd($request->session()->all());

            $userExist = User::whereEmail($request->email)->first();

            if (empty($userExist)) {
                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->name = $request->first_name . ' ' . $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                // $user->course_id            = $request->cid;
                $user->address = $request->address;
                $user->city = $request->city;
                $user->state = $request->state;
                $user->zip_code = $request->zip_code;
                // $user->type                 = 1;
                $user->email_verified_at = now();
                $user->password = Hash::make($request->password);
                $user->status = 1;
                // $user->department_id        = $department_id;
                $user->save();

                $username = intval(config('app.initial_username')) + $user->id;
                $user->username = strval($username);
                $user->save();
            } else {
                $user = $userExist;
            }

            $user->syncRoles([3]);
            session()->put('user_id', $user->id);
        }

        return redirect()->route('course.checkout.stripe');
    }
    public function checkoutStripe()
    {
        // dd(Session::all());

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $course = Course::find(session()->get('cid'));
        $lineItems = [];
        $totalPrice = 0;
        // foreach ($products as $product) {

        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $course->name,
                    'images' => [$course->image],
                ],
                'unit_amount' => $course->price * 100,
            ],
            'quantity' => 1,
        ];
        // }
        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout-course.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout-course.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
        ]);
        $fileData = session('file');
        $filename = "";
        if ($fileData) {

            $filename = Storage::disk('cms')->putFile('', $fileData);
        }
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'session_id' => $session->id,
            'status' => 'unpaid',
            'grand_total' => $course->price,
            'item_count' => 1,
            'user_id' => session('user_id'),
            'course_schedule_id' => session('course_schedule_id'),
            'course_id' => $course->id,
            'payment_status' => 0,
            'payment_method' => null,
            'first_name' => session('first_name'),
            'last_name' => session('last_name'),
            'email' => session('email'),
            'phone_number' => session('phone'),
            'notes' => session('message'),
            'file' => $filename,
        ]);
        // session()->forget(['date', 'cid', 'first_name', 'last_name', 'email', 'phone', 'message']);
        return view('layouts.stripe-redirect', compact('session'));
    }

    public function checkoutSuccess(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = Session::retrieve($sessionId);

            $user = User::find(session('user_id'));

            // dd($user,$session,$request->session()->all());
            if (!$user) {

                return redirect()->route('courses');
            }
            // $customer = \Stripe\Customer::retrieve($session->customer);

            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {

                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            $course = Course::find(session('cid'));
            if ($course?->type == 0) {
                CourseUserSchedule::create([
                    'user_id' => session('user_id'),
                    'course_id' => session('cid'),
                    'course_schedule_id' => session('course_schedule_id'),
                    'type' => 0,
                ]);
            } else {
                CourseUserSchedule::create([
                    'user_id' => session('user_id'),
                    'course_id' => session('cid'),
                    'course_schedule_id' => session('course_schedule_id'),
                    'type' => 1,
                ]);
            }

            // Mail::to($order->email)->send(new SuccessPurchased($user, $course, $order));
            session()->flush();
            return view('frontend.course-success', compact('user', 'course', 'order'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            throw new NotFoundHttpException();
        }
    }
    public function checkoutCancel(Request $request)
    {
        $sessionId = $request->get('session_id');
        $session = Session::retrieve($sessionId);
        $order = Order::where('session_id', $session->id)->first();
        $order->status = 'cancel';
        $order->save();
        session()->flush();
        return view('frontend.course-cancel');
    }
}
