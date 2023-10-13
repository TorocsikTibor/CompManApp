<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use App\Models\CompetitorRound;
use App\Models\Round;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoundController extends Controller
{
    public function index(int $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $competitors = Competitor::all();

        return view('round/create', [ 'id' => $id, 'competitors' => $competitors ]);
    }

    public function createRound(int $id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'competitors' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            DB::beginTransaction();
            try {
                $round = new Round;
                $round->name = $request->input('name');
                $round->competition_id = $id;
                $round->save();

                foreach ($request->competitors as $competitor) {
                    $competitorRound = new CompetitorRound;
                    $competitorRound->competitor_id = $competitor;
                    $competitorRound->round_id = $round->id;
                    $competitorRound->save();
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json([
                'status' => 200,
                'message' => 'Round created successfully',
            ]);
        }
        //todo json legyen visszakűldve alert a végén messszidzsel
        //todo admin gate policy
        //todo elemek törlése, szerekesztése
//        return redirect('home');
    }
}
