<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DepositForm;
use App\Models\Document;
use App\Models\EmpBcaForm;
use App\Models\MasterFiles\MFDocumentType;
use App\Models\Notification;
use App\Models\Traits\ApiResponser;
use App\Models\User;
use App\Models\W9Form;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClinicianController extends Controller
{
    use ApiResponser;

    public function documentUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required|string|max:255',
            'file'             => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx',
            'document_type_id' => 'required|integer|exists:document_types,id',
            // 'expiry_date'      => 'nullable|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        $document = Document::create([
            'title'            => $request->title,
            'document_type_id' => $request->document_type_id,
            'user_id'          => auth()->user()->id,
            'uploaded_by'      => auth()->user()->id,
            'notes'            => $request->notes,
            'expired_at'       => $request->expiry_date, // Add expiry date to creation
            'obtained_at'      => $request->obtained_date,
        ]);

        $file = null;

        // Check if the request has file
        if ($request->hasFile('file')) {
            $path = Storage::disk('cms')->put('', $request->file('file'));
            $file = $path; // Collect file paths
        }

        $document->update(['file' => $file]);

        return $this->success('Document Uploaded', 200);
    }
    public function documentType()
    {
        $document_types = MFDocumentType::get();
        return $this->success(['document_types' => $document_types], 'Document Types', 200);
    }
    public function userDocuments()
    {
        $documents = Document::where('uploaded_by', auth()->user()->id)->with('documentType', 'uploaded_clinician')->get();
        return $this->success(['documents' => $documents], 'Documents', 200);
    }
    public function w9Form(Request $request)
    {
        $data = [
            'user_id'                    => auth()->user()->id,
            'name'                       => $request->input('name'),
            'business_name'              => $request->input('business_name'),
            'faderal_tax_classification' => $request->input('faderal_tax_classification'),
            'classification_detail'      => $request->input('classification_detail'),
            'exempt_payee_code'          => $request->input('exempt_payee_code'),
            'fatca_code'                 => $request->input('fatca_code'),
            'address'                    => $request->input('address'),
            'city'                       => $request->input('city'),
            'state'                      => $request->input('state'),
            'zip_code'                   => $request->input('zip_code'),
            'requester_first_name'       => $request->input('requester_first_name'),
            'requester_last_name'        => $request->input('requester_last_name'),
            'requester_address'          => $request->input('requester_address'),
            'requester_city'             => $request->input('requester_city'),
            'requester_state'            => $request->input('requester_state'),
            'requester_zip_code'         => $request->input('requester_zip_code'),
            'account_number'             => $request->input('account_number'),
            'social_security_number'     => $request->input('social_security_number'),
            'ei_number'                  => $request->input('ei_number'),
        ];

        W9Form::create($data);

        return $this->success('W9 Form submitted successfully', 200);
    }

    public function bcaForm(Request $request)
    {
        $input            = $request->all();
        $input['user_id'] = auth()->user()->id;
        EmpBcaForm::create($input);

        return $this->success('BCA Form submitted successfully', 200);
    }
    public function depositForm(Request $request)
    {
        $input            = $request->all();
        $input['user_id'] = auth()->user()->id;
        DepositForm::create($input);

        return $this->success('Deposit Form submitted successfully', 200);
    }
    public function userInfo()
    {
        $user = User::where('id', getLoggedInUserId())->first();

        return $this->success($user->prepareData(), 'User profile get successfully', 200);
    }
    public function updateProfile(Request $request)
    {
        $user = User::where('id', getLoggedInUserId())->first();

        $file = $user->avatar; // keep old file by default

        // ✅ Only if new file uploaded
        if ($request->hasFile('image')) {
            // delete old only when new exists
            if ($user->avatar) {
                Storage::disk('cms')->delete($user->avatar);
            }

            $path = Storage::disk('cms')->put('', $request->file('image'));
            $file = $path;
        }

        $user->update([
            'avatar' => $file,
        ]);

        $phone            = $request->phone;
        $phoneWithoutPlus = str_replace('+', '', $phone);

        $data = [
            'first_name'         => $request->first_name ?? $user->first_name,
            'last_name'          => $request->last_name ?? $user->last_name,
            'name'               => ($request->first_name ?? $user->first_name) . ' ' . ($request->last_name ?? $user->last_name),
            'email'              => $request->email ?? $user->email,
            'phone'              => $phoneWithoutPlus,
            'zip_code'           => $request->zip_code ?? $user->zip_code,
            'address'            => $request->address ?? $user->address,
            'city'               => $request->city ?? $user->city,
            'state'              => $request->state ?? $user->state,
            'qualification_type' => $request->qualification_type ?? $user->qualification_type,
            'timezone'           => $request->timezone ?? $user->timezone,
        ];

        $user->update($data);

        return $this->success($user->prepareData(), 'User profile updated successfully', 200);
    }
    public function getUnreadNotifications()
    {
        $user         = auth()->user();
        $userTimezone = $user->timezone ?? config('app.timezone', 'UTC');

        $notifications = getNotification(Notification::CLINICIAN)
            ->map(function ($n) use ($userTimezone) {
                if (! empty($n->created_at)) {
                    $n->created_at = Carbon::parse($n->created_at, 'UTC')
                        ->setTimezone($userTimezone)
                        ->toIso8601String();
                }

                if (! empty($n->read_at)) {
                    $n->read_at = Carbon::parse($n->read_at, 'UTC')
                        ->setTimezone($userTimezone)
                        ->toIso8601String();
                }

                return $n;
            });

        return $this->success($notifications, 'Unread Notifications', 200);
    }

    public function getReadNotifications()
    {
        $user         = auth()->user();
        $userTimezone = $user->timezone ?? config('app.timezone', 'UTC');

        $notifications = Notification::whereUserId($user->id)
            ->whereNotificationFor(Notification::NOTIFICATION_FOR[Notification::CLINICIAN])
            ->whereNotNull('read_at')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($n) use ($userTimezone) {
                if (! empty($n->created_at)) {
                    $n->created_at = Carbon::parse($n->created_at, 'UTC')
                        ->setTimezone($userTimezone)
                        ->toIso8601String();
                }

                if (! empty($n->read_at)) {
                    $n->read_at = Carbon::parse($n->read_at, 'UTC')
                        ->setTimezone($userTimezone)
                        ->toIso8601String();
                }

                return $n;
            });

        return $this->success($notifications, 'Read Notifications', 200);
    }

    public function markAsReadNotification(Request $request)
    {
        $notification = Notification::findOrFail($request->id);
        $notification->update([
            'read_at' => now(), // stays in UTC in DB
        ]);

        return $this->success([], 'Notification marked as read', 200);
    }

    public function getCliniciansType(): JsonResponse
    {
        $clinicianTypes = [
            ['value' => 'CNA', 'label' => 'CNA'],
            ['value' => 'PST', 'label' => 'PST'],
            ['value' => 'Medication Technician', 'label' => 'Medication Technician'],
            ['value' => 'PCT', 'label' => 'PCT'],
            ['value' => 'PT', 'label' => 'PT'],
            ['value' => 'OT', 'label' => 'OT'],
            ['value' => 'RT', 'label' => 'RT'],
            ['value' => 'EKG Technician', 'label' => 'EKG Technician'],
            ['value' => 'LPN', 'label' => 'LPN'],
            ['value' => 'LVN/LPN', 'label' => 'LVN/LPN'],
            ['value' => 'ARNP', 'label' => 'ARNP'],
        ];

        return response()->json($clinicianTypes);
    }
}
