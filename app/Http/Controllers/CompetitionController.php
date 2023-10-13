<?php

namespace App\Http\Controllers;

use App\Models\Competition;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CompetitionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('competition/create');
    }

    public function createCompetition(Request $request): \Illuminate\Http\JsonResponse
    {


        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);
            } else {
                $competition = new Competition;

                $competition->name = $request->input('name');
                $competition->date = $request->input('date');
                $competition->save();

                return response()->json([
                    'status' => 200,
                    'errors' => 'Competition created successfully',
                ]);
            }
        } catch (Throwable $throwable) {
            return Response()->json([
                'status' => 500,
                'errors' => $throwable->getMessage(),
            ]);
        }
    }

    public function delete(int $id)
    {
        $competition = Competition::find($id);
        $competition->delete();

        return response()->json([
            'message' => 'success',
            'status' => 200,
        ]);
    }

    public function showUpdate(int $id)
    {
        $competition = Competition::find($id);

        return view('competition/update', ['competition' => $competition]);
    }

    public function update(int $id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $competition = Competition::find($id);
        $competition->fill($validator->validated());
        $competition->save();

        return response()->json([
            'status' => 200,
            'errors' => 'Competition created successfully',
        ]);

    }

}
