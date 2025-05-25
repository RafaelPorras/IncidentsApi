<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
USE Illuminate\Http\Response;

class IncidentController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Return a list of incidents
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $incidents = Incident::all();
        return $this->successResponse($incidents);
    }


    /**
     * Store a newly created incident in storage
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request){
        //rules for creating a incident
        $rules = [
            'incident_type' => 'required|string',
            'description' => 'required|string'
        ];

        //Validate the request
        $this->validate($request, $rules);

        //Create a new incident
        $incident = Incident::create($request->all());

        //return the new incident
        return $this->successResponse($incident);
    }

    /**
     * Return a specific Incident
     *
     * @param int $incident The ID of the incident to retrieve
     * @return Illuminate\Http\Response
     */
    public function show($incident){
        //find a specific incident
        $incident = Incident::FindOrFail($incident);

        //return a specific incident
        return $this->successResponse($incident);

    }
 
    /**
     * Update a specific Incident
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $incident The ID of the incident to retrieve
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $incident){

        //rules for upddating incident
        $rules =[
             'incident_type' => 'string',
            'description' => 'string'
        ];

        //Validate the request
        $this->validate($request,$rules);

        //Find a specific incident
        $incident = Incident::FindOrFail($incident);

        //Update the incident
        $incident->fill($request->all());

        //Check if the incident has changed
        if($incident->isClean()){
            return $this->errorResponse('At least one value must be change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //save the incident
        $incident->save();

        //return the changed incident
        return $this->successResponse($incident);

    }

    /**
     * Delete a specific incident
     * 
     * @param int $incident The ID of the incident to retrieve
     * @return Illuminate\Http\Response
     */
    public function delete($incident){
        //find a specific incident
        $incident = Incident::FindOrFail($incident);

        //Delete the specific incident
        $incident->delete();

        //Return the deleted incident
        return $this->successResponse($incident);
    }
}
