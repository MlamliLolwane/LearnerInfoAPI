<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use App\Http\Requests\StoreLearnerRequest;
use App\Http\Requests\UpdateLearnerRequest;
use Illuminate\Http\Response;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $learners = Learner::all();

        return response()->json(['data' => $learners], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLearnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLearnerRequest $request)
    {
        $request->validated();

        $learner = Learner::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_id' => $request->contact_id
        ]);

        return response()->json($learner, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function show($learner_id)
    {
        //Find the learner with the specified id from the database
        $learner = Learner::findOrFail($learner_id);

        return response($learner, Response::HTTP_OK);
    }


    public function update(UpdateLearnerRequest $request, $learner_id)
    {
        $request->validated();

        try {
            $updated_learner = Learner::where('id', $learner_id)->update($request->all());

            return response()->json($updated_learner, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function destroy($learner_id)
    {
        $learner = Learner::where('id', $learner_id)->delete();

        return response()->json($learner, Response::HTTP_OK);
    }
}
