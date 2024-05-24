<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Job_working_place;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AddressControllers extends Controller {

    public function getPrefectureList() {
        {
            try {
                $ken_list = Address::select('ken_id', 'ken_name')
                    ->where('delete_flg', 0)
                    ->groupBy('ken_id', 'ken_name')
                    ->orderBy('ken_id')
                    ->get();
            } catch (\Exception $e) {
                throw new HttpException(500, $e->getMessage(), $e);
            }
            return $ken_list;
        }
    }

    public function getCityList($prefecture) {
        {
        try {
            $city_list = Address::select('city_id', 'city_name')
                ->where('ken_id',$prefecture)
                ->groupBy('city_id', 'city_name')
                ->orderBy('city_id')
                ->get();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage(), $e);
        }
        return $city_list;
        }
    }

    public function getJobsKenGroupList($ken_group_id)
    {
        {
            try {
                $ken_list = Job_working_place::select('addresses.ken_id', 'addresses.ken_name')
                    ->leftJoin('addresses', 'job_working_places.ken_id', 'addresses.ken_id')
                    ->where('addresses.ken_group_id', $ken_group_id)
                    ->where('addresses.delete_flg', 0)
                    ->groupBy('addresses.ken_id', 'addresses.ken_name')
                    ->orderBy('addresses.ken_id')
                    ->get();
            } catch (\Exception $e) {
                throw new HttpException(500, $e->getMessage(), $e);
            }
            return $ken_list;
        }
    }
    public function getJobsCityGroupList($ken_group_id)
    {
        {

            try {
                $city_group_list = Job_working_place::select('addresses.city_group_id','addresses.city_group_name')
                    ->leftJoin('addresses', 'job_working_places.city_id', 'addresses.city_id')
                    ->where('addresses.ken_group_id', $ken_group_id)
                    ->where('addresses.delete_flg', 0)
                    ->groupBy('addresses.city_group_id','addresses.city_group_name')
                    ->orderBy('addresses.city_group_id')
                    ->get();
            } catch (\Exception $e) {
                throw new HttpException(500, $e->getMessage(), $e);
            }
            return $city_group_list;
        }
    }
    public function getKenCityByPost($zip)
    {
        try {
            $zipcode = '';
            if (strpos($zip, '-') === false) {
                $zipcode = substr($zip, 0, 3) . "-" . substr($zip, 3);
            }
            $kenCity = Address::select('addresses.ken_id', 'addresses.city_id')
                ->where('addresses.zip', $zipcode)
                ->where('addresses.delete_flg', 0)
                ->groupBy('addresses.ken_id', 'addresses.city_id')
                ->get();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage(), $e);
        }
        return $kenCity;
    }
}
