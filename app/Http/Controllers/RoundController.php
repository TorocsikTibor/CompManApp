<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use App\Models\Round;
use App\Services\RoundService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RoundController extends Controller
{
    private RoundService $roundService;

    public function __construct(RoundService $roundService)
    {
        $this->roundService = $roundService;
    }

    public function index(int $id): View|Application|Factory
    {
        $competitors = Competitor::all();

        return view('round/create', ['id' => $id, 'competitors' => $competitors]);
    }

    public function createRound(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'competitors' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $validated = $validator->validated();
        $this->roundService->create($validated['name'], $id, $validated['competitors']);

        return response()->json([
            'status' => 201,
            'message' => 'Round created successfully',
        ]);
    }

    public function showUpdate(int $id): View|Application|Factory
    {
        $round = Round::find($id);
        $competitors = Competitor::all();

        return view('round/update', ['round' => $round, 'competitors' => $competitors]);
    }

    /**
     * @throws ValidationException
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'competitors' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $validated = $validator->validated();
        $this->roundService->update($id, $validated['name'], $validated['competitors']);

        return response()->json([
            'status' => 200,
            'message' => "Updated succesfully",
        ]);
    }

    public function delete(int $id)
    {
        $this->roundService->delete($id);

        return response()->json([
            'message' => 'success',
            'status' => 200,
        ]);
    }
}
