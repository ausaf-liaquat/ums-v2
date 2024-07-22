<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DepositForm;
use App\Models\Document;
use App\Models\EmpBcaForm;
use App\Models\MasterFiles\MFDocumentType;
use App\Models\Traits\ApiResponser;
use App\Models\User;
use App\Models\W9Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClinicianController extends Controller
{
    use ApiResponser;

    public function documentUpload(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|file',
            'document_type_id' => 'required',
        ]);

        $document = Document::create([
            'title'               => $request->title,
            'mf_document_type_id' => $request->document_type_id,
            'user_id'             => auth()->user()->id,
            'uploaded_by'         => auth()->user()->id,
            'notes'               => $request->notes,
        ]);

        if ($request->file('file')) {
            Storage::disk('cms')->delete($document->image);
        }

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
        $document_types = MFDocumentType::whereStatus(1)->get();
        return $this->success(['document_types' => $document_types], 'Document Types', 200);
    }
    public function userDocuments()
    {
        $documents = Document::where('uploaded_by', auth()->user()->id)->with('documentType')->get();
        return $this->success(['documents' => $documents], 'Documents', 200);
    }
    public function w9Form(Request $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->input('name'),
            'business_name' => $request->input('business_name'),
            'faderal_tax_classification' => $request->input('faderal_tax_classification'),
            'classification_detail' => $request->input('classification_detail'),
            'exempt_payee_code' => $request->input('exempt_payee_code'),
            'fatca_code' => $request->input('fatca_code'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'requester_first_name' => $request->input('requester_first_name'),
            'requester_last_name' => $request->input('requester_last_name'),
            'requester_address' => $request->input('requester_address'),
            'requester_city' => $request->input('requester_city'),
            'requester_state' => $request->input('requester_state'),
            'requester_zip_code' => $request->input('requester_zip_code'),
            'account_number' => $request->input('account_number'),
            'social_security_number' => $request->input('social_security_number'),
            'ei_number' => $request->input('ei_number'),
        ];

        W9Form::create($data);

        return $this->success('W9 Form submitted successfully', 200);
    }

    public function bcaForm(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        EmpBcaForm::create($input);

        return $this->success('BCA Form submitted successfully', 200);
    }
    public function depositForm(Request $request)
    {
        $input = $request->all();
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

        $input = $request->all();

        $user = User::where('id', getLoggedInUserId())->first();

        if ($request->file('image')) {
            Storage::disk('cms')->delete($user->avatar);
        }

        $file = null;

        // Check if the request has file
        if ($request->hasFile('image')) {
            $path = Storage::disk('cms')->put('', $request->file('image'));
            $file = $path; // Collect file paths
        }

        $user->update([
            'avatar' => $file,
        ]);
        $phone = $request->phone;
        $phoneWithoutPlus = str_replace('+', '', $phone);
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name'  =>$request->first_name.' '. $request->last_name,
            'email' => $request->email,
            'phone' => $phoneWithoutPlus,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'qualification_type' => $request->qualification_type,
        ];

        $user->update($data);

        return $this->success($user->prepareData(), 'User profile updated successfully', 200);
    }

    public function getUnreadNotifications()
    {

        return $this->success(getNotification(Notification::PATIENT), 'Unread Notifications', 200);
    }
    public function getReadNotifications()
    {
        $notifications = Notification::whereUserId(Auth::id())->whereNotificationFor(Notification::NOTIFICATION_FOR[Notification::PATIENT])->whereNotNull('read_at')->orderByDesc('created_at')->toBase()->get();
        return $this->success($notifications, 'Read Notifications', 200);
    }
    public function markAsReadNotification(Request $request)
    {
        $notification = Notification::whereId($request->id)->firstOrFail();
        $notification->update([
            'read_at' => now(),
        ]);
        return $this->success([], 'Notification mark as read', 200);
    }
}
