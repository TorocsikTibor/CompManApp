<?php

namespace App\Http\Controllers;

use App\Models\Competition;

use App\Services\CompetitionService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

class CompetitionController extends Controller
{
    private CompetitionService $competitionService;

    public function __construct(CompetitionService $competitionService)
    {
        $this->competitionService = $competitionService;
    }

    public function index(): View|Application|Factory
    {
        return view('competition/create');
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'date' => 'required|date|after:yesterday',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            }

            $validated = $validator->validated();
            $this->competitionService->createOrUpdate(null, $validated['name'], $validated['date']);

            return response()->json([
                'status' => 201,
                'message' => 'Competition created successfully',
            ]);

        } catch (Throwable $throwable) {
            return Response()->json([
                'status' => 500,
                'errors' => $throwable->getMessage(),
            ]);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $this->competitionService->delete($id);

        return response()->json([
            'message' => 'success',
            'status' => 200,
        ]);
    }

    public function showUpdate(int $id): View|Application|Factory
    {
        $competition = Competition::find($id);

        return view('competition/update', ['competition' => $competition]);
    }

    /**
     * @throws ValidationException
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date|after:yesterday',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $validated = $validator->validated();
        $this->competitionService->createOrUpdate($id, $validated['name'], $validated['date']);

        return response()->json([
            'status' => 200,
            'errors' => 'Competition created successfully',
        ]);

    }

}
