<?php

namespace App\Services;

use App\Repositories\Interfaces\RfiRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RfiService
{

    public function __construct(RfiRepositoryInterface $rfiRepository)
    {
        $this->rfiRepository = $rfiRepository;
    }

    public function getAll()
    {
        return $this->rfiRepository->getAll();
    }


    public function getDataToCreate()
    {
        return $this->rfiRepository->getDataToCreate();
    }



    public function getRfiOverviewByUser($user_id)
    {
        return $this->rfiRepository->getRfiOverviewByUser($user_id);
    }


    public function storeRfiOverviewByUser(array $data)
    {
        if(empty($data['cost_impact'])) {
            $cost_impact = 0;
        } else {
            $cost_impact = 1;
        }
        if(empty($data['schedule_impact'])) {
            $schedule_impact = 0;
        } else {
            $schedule_impact = 1;
        }


        $rfiOverview = array(
            'question'          => $data['question'],
            'sugestion'         => $data['sugestion'],
            'cost_impact'       => $cost_impact,
            'schedule_impact'   => $schedule_impact,
            'deadline'          => $data['deadline'],
            'status'            => 1,
            'user_id'           => Auth::user()->id,
        );

        $rfiOverview_id = $this->rfiRepository->storeRfiOverviewByUser($rfiOverview);


    }



    public function updateRfiOverviewByUser(array $data)
    {

        if(empty($data['cost_impact'])) {
            $cost_impact = 0;
        } else {
            $cost_impact = 1;
        }
        if(empty($data['schedule_impact'])) {
            $schedule_impact = 0;
        } else {
            $schedule_impact = 1;
        }
        if(empty($data['solved'])) {
            $status = 0;
        } else {
            $status = 1;
        }

        $rfiOverview = array(
            'rfi_overview'      => $data['rfi_overview'],
            'question'          => $data['question'],
            'sugestion'         => $data['sugestion'],
            'client_answear'    => $data['client_answear'],
            'cost_impact'       => $cost_impact,
            'schedule_impact'   => $schedule_impact,
            'deadline'          => $data['deadline'],
            'status'            => $status,
            'user_id'           => Auth::user()->id,
        );


        $updateOverview_id = $this->rfiRepository->updateRfiOverviewByUser($rfiOverview);

    }



    // Clear all temporary RFI Overviews records
    public function deleteRfiOverview(array $data)
    {
        $del = $this->rfiRepository->deleteRfiOverview($data['rfi_overview_id']);
    }


    public function getRfiOverview($rfi_overview_id) {
        return $this->rfiRepository->getRfiOverview($rfi_overview_id);
    }



    // Save RFI ALL FORM
    public function store(array $data)
    {

        $rfi = array(
            'project_id'        => $data['project_id'],
            'reference'         => $data['reference'],
            'rfi_date'          => $data['rfi_date'],
            'received_from'     => Auth::user()->id,
            'status'            => 0,
        );

        $rfi_id = $this->rfiRepository->store($rfi);


        // PREENCHER O CÓDIGO DO RFI NA TABELA OVERVIEWS ONDE O USUÁRIO IGUAL AO LOGADO E RFI IGUAL A rfi_id
        try {
            $overview = array(
                'rfi_id'   => $rfi_id,
                'user_id'  => Auth::user()->id,
            );

            $update = $this->rfiRepository->updateOverviewFilled($overview);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }


    public function storeFile(array $data)
    {

        $file = $data['image'];
        $filename = $file->getClientOriginalName(); // Retrieve the original filename

        $uuid = Str::uuid();

        // Get extension name to concat in file name
        $EXT = explode('.', $filename);
        $name = $uuid.'.'.$EXT[1];
        $type_document_id = 17; // CÓDIGO DO type document DO RFI
        $path = $type_document_id.'/'.substr($uuid,0,2).'/'.substr($uuid,2,2).'/'.substr($uuid,4,2).'/'.substr($uuid,6,2).'/';

        // break uuid to formate path (type_document_id/aa/bb/cc/dd) four part at one
        // example: 1/90/d8/12/84/
        $path = $type_document_id.'/'.substr($uuid,0,2).'/'.substr($uuid,2,2).'/'.substr($uuid,4,2).'/'.substr($uuid,6,2).'/';

        Storage::disk('local')->put($path.'/'.$name, file_get_contents($file));

        if(empty($data['rfi_overview_id'])) {
            $rfi_overview_id = null;
        } else {
            $rfi_overview_id = $data['rfi_overview_id'];
        }

        $datafile = array(
            'uuid'              => $uuid,
            'rfi_overview_id'   => $rfi_overview_id,
            'name'              => $name,
            'type_document_id'  => $type_document_id,
            'original_name'     => $data['original_name'],
            'file_comment'      => $data['file_comment'],
            'user_id'           => Auth::user()->id,
        );


        $file_id = $this->rfiRepository->storeFile($datafile);
        // end MAIN TABLE

    }

    public function getFileByUser($user_id) {
        return $this->rfiRepository->getFileByUser($user_id);
    }



    // Clear all temporary RFI Overviews records
    public function deleteRfiOverviewByUser(array $data)
    {
        $del = $this->rfiRepository->deleteRfiOverviewByUser($data['user_id']);
    }



    // Clear all temporary RFI Files records
    public function deleteTempFilesByUser(array $data)
    {
        $del = $this->rfiRepository->deleteTempFilesByUser($data['user_id']);
    }

}
