<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Models\Blob;
use App\Models\Company;
use App\Models\User;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AssetController extends Controller
{
    const ASSETS_PER_PAGE = 10;

    private Filesystem $blobFs;

    public function __construct()
    {
        $this->blobFs = Storage::disk('blobs');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $this->authorize('viewAny', Asset::class);

        $assets = Asset::with(['company', 'user', 'blob'])->paginate(self::ASSETS_PER_PAGE);
        $currentPage = $request->query('page', '1');

        if ($currentPage < 1 || $currentPage > $assets->lastPage()) {
            return redirect($request->fullUrlWithoutQuery('page'));
        }

        return response()->view('assets.list', ['assets' => $assets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        abort(404);
    }

    /**
     * Fetch the contents of the desired asset.
     *
     * Example: "f9d207fd-bd70-37ee-a72d-ab96591ac688.png"
     *
     * @param string $name Expected be a UUID followed by a file extension.
     */
    public function show(string $name): Response
    {
        $name = Str::of($name)->lower();

        // should contain the UUID part of the asset...
        $uuid = pathinfo($name->basename(), PATHINFO_FILENAME);
        // ...if not, 404
        if (! Str::isUuid($uuid)) {
            abort(404);
        }

        // get the MIME type, (e.g. ".png" -> "image/png")
        $mimeType = MimeType::fromFilename($name);

        // fetch the coresspoding blob & asset from the database, or return 404
        $asset = Asset::with('blob')
            ->whereRelation('blob', 'uuid', $uuid)
            ->where('mime_type', $mimeType)
            ->firstOrFail();
        $blob = $asset->blob;

        $this->authorize('view', $asset);

        // try to read the blob's contents at storage/blobs/<uuid>
        $contents = $this->blobFs->get($blob->uuid);

        if ($contents === null) {
            // should only happen if something wrong happened to the database
            Log::error("Tried to access blob $blob->uuid, which is in the database, but not in storage");
            abort(404);
        }

        // give the blob to the user with the appropriate type.
        return response($contents)
            ->header('Content-Type', $asset->mime_type);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset): Response
    {
        $this->authorize('update', $asset);

        return response()->view('assets.edit', ['asset' => $asset]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $asset): Response
    {
        $this->authorize('update', $asset);

        DB::transaction(function () use ($request, $asset) {
            $validated = $request->validated();
            /** @var User */
            $user = $request->user();

            $blob = Blob::find($validated['blob-id']);
            $owner = User::where('email', $validated['user'])->first();
            $company = Company::find($validated['company-id']);

            $asset->forceFill([
                'name' => $validated['name'],
                'blob_id' => $blob->id,
                'mime_type' => $validated['mime-type'],
                'created_at' => $validated['creation-date'],
                'user_id' => $owner?->id,
                'company_id' => $company?->id,
                'access' => $validated['access'],
            ]);

            $asset->blob()->associate($blob);
            $asset->user()->associate($owner);
            $asset->company()->associate($company);
            $asset->save();

            Log::info("Asset (#$asset->id) updated by admin user #$user->id");
        });

        return redirect()->route('assets.edit', $asset->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset): Response
    {
        $this->authorize('delete', $asset);

        $id = $asset->id;
        $asset->delete();
        Log::info("Deleted asset #$id");

        return redirect()->route('assets.index');
    }
}
