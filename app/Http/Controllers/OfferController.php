<?php

namespace App\Http\Controllers;
use App\DataTables\Offers\OffersDataTable;
use App\Models\Offer;
use Illuminate\Http\Request;
use Auth;

class OfferController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function index(OffersDataTable $dataTable, Request $request)
    {
        $data_count  = Offer::count();


        return $dataTable->render('admin.offers.index', compact('data_count'));
    }
}
