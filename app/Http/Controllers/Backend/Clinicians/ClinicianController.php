<?php
namespace App\Http\Controllers\Backend\Clinicians;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Facilities\BannedFacilityClinician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ClinicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.clinicians.index');
    }

    public function dataTable(Request $request)
    {

        $model = User::query()
            ->with(['documents' => function ($q) {
                $q->select('id', 'uploaded_by', 'expired_at');
            }])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'clinician');
            })
            ->when($request->has('document_expiry') && !empty($request->document_expiry), function ($q) use ($request) {
                $date = \Carbon\Carbon::parse($request->document_expiry)->format('Y-m-d');
                $q->whereHas('documents', function ($query) use ($date) {
                    $query->whereDate('expired_at', $date);
                });
            });

        return DataTables::eloquent($model)->addIndexColumn()->addColumn('resume', function (User $user) {
            $asset = Storage::disk('cms')->url($user->resume);
            return ($user->resume && Storage::disk('cms')->exists($user->resume ?? '')) ? "<a href='$asset' target='_blank'>Resume</a>" : "";
        })->addColumn('status', function (User $user) {
            $facilities = User::whereHas('roles', function ($q) {
                $q->where('name', 'facility');
            })->get();

            $facilityOptions = "";
            $statuses        = $user->bannedFacilities->pluck('facility_id')->toArray();
            foreach ($facilities as $key => $facility) {
                $facilityOptions .= "<option value='$facility->id' " . (in_array($facility->id, $statuses) ? 'selected' : '') . ">{$facility->name}</option>";
            }

            return "
                <select class='facility_select' data-id='{$user->id}' multiple>
                    $facilityOptions
                </select>
            ";
        })
        // ->filterColumn('documents.expired_at', function ($query, $keyword) {
        //     // dd($keyword);
        //     $date = \Carbon\Carbon::parse($keyword)->format('Y-m-d');
        //     $query->whereHas('documents', function ($q) use ($date) {
        //         $q->whereDate('expired_at', $date);
        //     });
        // })
            ->rawColumns(['status', 'resume'])->make(true);
    }
    public function documentsDataTable(Request $request)
    {

        $model = Document::query()->where('uploaded_by', $request->userID)->with('document_type', 'uploaded_clinician');

        return DataTables::eloquent($model)->addIndexColumn()->addColumn('file', function (Document $document) {
            $asset = Storage::disk('cms')->url($document->file);

            return ($document->file && Storage::disk('cms')->exists($document->file ?? '')) ? "<a href='$asset' target='_blank'><span class='badge bg-label-success'>View File</span> </a>" : "<span class='badge bg-label-danger'>File Doesn't Exist</span>";
        })->rawColumns(['file'])->make(true);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $clinician)
    {
        $data = [
            'isEdit'    => true,
            'clinician' => $clinician,
        ];

        return view('backend.clinicians.add', $data);
    }

    public function update(User $clinician, Request $request)
    {
        // $phone = $request->phone;
        // $phoneWithoutPlus = str_replace('+', '', $phone);
        $data = [
            // 'first_name' => $request->first_name,
            // 'last_name' => $request->last_name,
            // 'name'  => $request->first_name . ' ' . $request->last_name,
            // 'email' => $request->email,
            // 'phone' => $phoneWithoutPlus,
            // 'gender' => $request->gender == 'male' ? 0 : 1,
            // 'zip_code' => $request->zip_code,
            // 'shifts' => $request->shift,
            // 'experience' => $request->experience,
            // 'reffered_by' => $request->reffered_by,
            'qualification_type' => $request->qualification_type,
        ];

        $clinician->update($data);
        return redirect()->route('backend.clinicians');

    }

    public function facilityBanned(Request $request)
    {
        // dd($request->id);
        // $patient = Patient::find($request->id);

        // Get the existing facility IDs associated with the patient
        $existingFacilityIds = BannedFacilityClinician::where('user_id', $request->id)
            ->pluck('facility_id')
            ->toArray();

        // Check for facility IDs that need to be removed
        $facilityIdsToRemove = array_diff($existingFacilityIds, $request->facility_ids ?? []);

        // Remove the facility IDs that are no longer selected
        BannedFacilityClinician::where('user_id', $request->id)
            ->whereIn('facility_id', $facilityIdsToRemove)
            ->delete();

        // Add new facility IDs that are not already associated
        foreach ($request->facility_ids ?? [] as $value) {
            if (! in_array($value, $existingFacilityIds)) {
                BannedFacilityClinician::create([
                    'user_id'     => $request->id,
                    'facility_id' => $value,
                ]);
            }
        }

        return response()->json([], 200);
    }
}
