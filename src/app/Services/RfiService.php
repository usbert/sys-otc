<?php

namespace App\Services;

use App\Repositories\Interfaces\RfiRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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

    // Clear all temporary RFI Overviews records
    public function deleteRfiOverview(array $data)
    {
        $del = $this->rfiRepository->deleteRfiOverview($data['rfi_overview_id']);
    }


    public function getRfiOverview($rfi_overview_id) {
        return $this->rfiRepository->getRfiOverview($rfi_overview_id);
    }


    // Clear all temporary RFI Overviews records
    public function deleteRfiOverviewByUser(array $data)
    {
        $del = $this->rfiRepository->deleteRfiOverviewByUser($data['user_id']);
    }



}
