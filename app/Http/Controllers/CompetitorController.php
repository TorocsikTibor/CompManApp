<?php

namespace App\Http\Controllers;

use App\Services\CompetitorService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitorController extends Controller
{
    private CompetitorService $competitorService;

    public function __construct(CompetitorService $competitorService)
    {
        $this->competitorService = $competitorService;
    }

    public function index(): View|Application|Factory
    {
        return view('competitor/create');
    }

    public function createCompetitor(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birthday' => 'required|date|before:today',
            'nationality' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $validated = $validator->validated();
        $this->competitorService->create($validated['name'], $validated['birthday'], $validated['nationality']);

        return response()->json([
            'status' => 201,
            'message' => 'Competitor created successfully',
        ]);
    }

    public function deleteFromComp(int $competitorId, int $competitionId): JsonResponse
    {
        $this->competitorService->deleteFromCompetition($competitorId, $competitionId);

        return response()->json([
            'message' => 'success',
            'status' => 200,
        ]);
    }

}
