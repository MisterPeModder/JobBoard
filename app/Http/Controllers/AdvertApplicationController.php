<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertApplicationRequest;
use App\Http\Requests\UpdateAdvertApplicationRequest;
use App\Models\Advert;
use App\Models\Application;
use App\Models\ApplicationAttachment;
use App\Models\Asset;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdvertApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $this->authorize('viewAny', $company->adverts->first()->applications->first());

        return response()->view('applications.index', ['company' => $company]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Advert $job): Response
    {
        return response()->view('job-application', ['advert' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Advert $job, StoreAdvertApplicationRequest $request)
    {
        // if an exception occurs in a transactions, all changes are rolled back.
        DB::transaction(function () use ($job, $request) {
            $validated = $request->validated();
            $user = Auth::user();

            if ($user === null) {
                // create a temporary user if not logged
                $user = User::create([
                    'email' => $validated['email'],
                    'name' => $validated['name'],
                    'surname' => $validated['surname'],
                    'phone_number' => $validated['phone-number'],
                ]);
            }

            // create the application
            $application = Application::create([
                'advert_id' => $job->id,
                'applicant_id' => $user->id,
                'content' => $validated['message'],
            ]);

            // store the attachments
            if ($request->hasFile('attachments') && $user->can('create', Asset::class)) {
                foreach ($request->file('attachments') as $i => $file) {
                    $asset = Asset::factory()
                        ->storeFile($file, 'attachment_'.$job->id."_$i")
                        ->create();
                    $asset->user()->associate($user);
                    $asset->company()->associate($job->company);
                    $asset->save();

                    $attachment = ApplicationAttachment::create([
                        'asset_id' => $asset->id,
                        'application_id' => $application->id,
                    ]);
                    Log::info("Application attachment (#$attachment->id) of type $asset->mime_type  created for application #$application->id with asset #$asset->id");
                }
            }

            Log::info("Application (#$application->id) filed for advert #$job->id with user #$user->id, ");
        });

        return redirect()->route('jobs.index', ['applied' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application): Response
    {
        $this->authorize('view', $application);

        Log::info("Showing application #$application->id");

        return response()->view('applications.show', ['application' => $application]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application): Response
    {
        return response()->view('applications.edit', ['application' => $application]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateJobApplicationRequest $request
     * @param App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertApplicationRequest $request, Application $application)
    {
        $request->validated();

        $application->update([
            'content' => $request->content,
        ]);

        return redirect()->view('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->view('/');
    }

    /**
     * Set application status to 'accepted'
     *
     * @param App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function updateAccepted(Application $application)
    {
        $application->update([
            'status' => 'accepted',
        ]);

        return response()->view('applications.index', ['company' => $application->advert->company]);
    }

    /**
     * Set application status to 'accepted'
     *
     * @param App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function updateDenied(Application $application)
    {
        $application->update([
            'status' => 'denied',
        ]);

        return response()->view('applications.index', ['company' => $application->advert->company]);
    }
}
