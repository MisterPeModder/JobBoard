<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\Advert;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('jobs');
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
    public function store(Advert $job, StoreJobApplicationRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'phone_number' => $validated['phone-number'],
        ]);
        $application = Application::create([
            'advert_id' => $job->id,
            'applicant_id' => $user->id,
            'content' => $validated['message'],
        ]);

        Log::info("Application (#$application->id) filed for advert #$job->id with user #$user->id");

        return redirect()->route('jobs', ['applied' => 1]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application): Response
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application): Response
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobApplicationRequest $request, Application $application): Response
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application): Response
    {
        abort(404);
    }
}
