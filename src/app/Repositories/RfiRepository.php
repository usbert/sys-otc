<?php

namespace App\Repositories;

use App\Models\FileRfi;
use App\Repositories\Interfaces\RfiRepositoryInterface;
use App\Models\Project;
use App\Models\Rfi;
use App\Models\RfiOverview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RfiRepository implements RfiRepositoryInterface
{

    public function getAll()
    {
        $addresses = Rfi::select(
            'rfis.id',
            'rfis.reference',
            'users.name as received_from',
            'rfis.rfi_date',
            'projects.contract_number',
            'projects.name as contract_name',
            'status',
        )
        ->selectRaw('lpad(rfis.id, 5, 0) as code')
        ->leftJoin('users', 'users.id', '=', 'rfis.received_from')
        ->leftJoin('projects', 'projects.id', '=', 'rfis.project_id')
        ->where('rfis.is_activated', Rfi::ACTIVATED)
        ->get();

        return $addresses;

    }

    public function getDataToCreate()
    {
        $projectCombo   = Project::select('id','name')->
        where('is_activated', Project::ACTIVATED)
        ->orderBy('name', 'asc')
        ->get();

        $rfiOverviewCombo = RfiOverview::select(
            'id',
        )
        ->selectRaw('CONCAT(\'RO\', lpad(rfi_overviews.id, 3, 0)) as code')
        ->get();

        $return = array(
            'projectCombo'      => $projectCombo,
            'rfiOverviewCombo'  => $rfiOverviewCombo,
        );

        return $return;

    }



    public function getRfiOverviewByUser($user_id) {

        $rfiOverview = RfiOverview::select(
            'rfi_overviews.id',
            'question',
            'sugestion',
            'client_answear',
            'users.name as from',
            'cost_impact',
            'schedule_impact',
            'deadline',
            'status',
        )
        ->selectRaw('CONCAT(\'RO\', lpad(rfi_overviews.id, 3, 0)) as code')
        ->where('user_id', $user_id)
        ->where('rfi_id', null)
        ->leftJoin('users', 'users.id', '=', 'rfi_overviews.user_id')
        ->orderBy('id')
        ->get();

       return $rfiOverview;

    }


    public function storeRfiOverviewByUser($data)
    {
        return RfiOverview::create($data)->rfi_overview_id;
    }


    public function deleteRfiOverview($rfi_overview_id) {
        try {
            $return = RfiOverview::where("id", $rfi_overview_id)
            ->delete();
            return $return;
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function getRfiOverview($rfi_overview_id) {

        try {

            $rfiOverview = RfiOverview::select(
               'rfi_id',
                'user_id',
                'question',
                'sugestion',
                'client_answear',
                'cost_impact',
                'schedule_impact',
                'deadline',
                'status'
            )
            ->where('id', $rfi_overview_id)
            ->get();

            return $rfiOverview;


        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function updateRfiOverviewByUser(array $data)
    {
        try {

            $input                  = RfiOverview::find($data['rfi_overview']);
            $input->question        = $data['question'];
            $input->sugestion       = $data['sugestion'];
            $input->client_answear  = $data['client_answear'];
            $input->cost_impact     = $data['cost_impact'];
            $input->schedule_impact = $data['schedule_impact'];
            $input->deadline        = $data['deadline'];
            $input->status          = $data['status'];
            $input->user_id         = Auth::user()->id;

            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function store($data)
    {
        return Rfi::create($data)->id;

    }



    public function updateOverviewFilled(array $data)
    {
        try {

            RfiOverview::where('user_id', $data['user_id'])
            ->whereNull('rfi_id')
            ->update([
                'rfi_id' => $data['rfi_id']
              ]
            );

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }


    }


    public function storeFile($data)
    {
      return FileRfi::create($data)->id;
    }


    // Clear all temporary RFI Overviews records
    public function deleteRfiOverviewByUser($user_id) {
        try {
            $return = RfiOverview::where("user_id", $user_id)
            ->delete();
            return $return;
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function getFileByUser($user_id) {

        $fileRfi = FileRfi::select(
            'file_rfis.id',
            'file_rfis.uuid',
            'file_rfis.name as file_name',
            'file_rfis.original_name',
            'file_rfis.file_comment',
        )
        ->selectRaw('CONCAT(\'RO\', lpad(file_rfis.rfi_overview_id, 3, 0)) as rfi_overview')
        ->where('file_rfis.user_id', $user_id)
        ->whereNull('file_rfis.rfi_id')
        ->leftJoin('rfi_overviews', 'rfi_overviews.id', '=', 'file_rfis.rfi_overview_id')
        ->orderBy('file_rfis.original_name')
        ->get();

       return $fileRfi;

    }


    public function deleteFile($id)
    {
        $file = FileRfi::select(
            'file_rfis.type_document_id',
            'name',
        )
        ->where('file_rfis.id', $id)
        ->get();
        $data = json_decode($file);


        // main folder
        $type_document_id = $data[0]->type_document_id;
        // others folders and file name
        $name = $data[0]->name;

        // Restore folders path
        $path = $type_document_id.'/'.substr($name,0,2).'/'.substr($name,2,2).'/'.substr($name,4,2).'/'.substr($name,6,2).'/';
        // remove file
        Storage::disk('local')->delete($path.'/'.$name);

        // delete register
        $return = FileRfi::destroy($id);
        return $return;
    }




    // Clear all temporary RFI Files records
    public function deleteTempFilesByUser($user_id)
    {
        $file = FileRfi::select(
            'file_rfis.id',
            'file_rfis.type_document_id',
            'name',
        )
        ->where('file_rfis.user_id', $user_id)
        ->whereNull('file_rfis.rfi_id')
        ->get();
        $data = json_decode($file);

        for($i = 0; $i<count($data); $i++) {

            $id                 = $data[$i]->id;
            $type_document_id   = $data[$i]->type_document_id;
            $name               = $data[$i]->name;

            // Restore folders path
            $path = $type_document_id.'/'.substr($name,0,2).'/'.substr($name,2,2).'/'.substr($name,4,2).'/'.substr($name,6,2).'/';
            // remove file
            Storage::disk('local')->delete($path.'/'.$name);

            // delete register
            FileRfi::destroy($id);

        }


    }


}

