<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\ZonePrices\CreateZonePriceRequest;
use App\Http\Requests\ZonePrices\UpdateZonePriceRequest;
use App\Repositories\ZonePrices\ZonePriceRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\ZonePrices\ZonePrice;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ZonePriceController extends InfyOmBaseController
{
    /** @var  ZonePriceRepository */
    private $zonePriceRepository;

    public function __construct(ZonePriceRepository $zonePriceRepo)
    {
        $this->zonePriceRepository = $zonePriceRepo;
    }

    /**
     * Display a listing of the ZonePrice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->zonePriceRepository->pushCriteria(new RequestCriteria($request));
        $zonePrices = $this->zonePriceRepository->all();
        return view('admin.zonePrice.zonePrices.index')
            ->with('zonePrices', $zonePrices);
    }

    /**
     * Show the form for creating a new ZonePrice.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.zonePrice.zonePrices.create');
    }

    /**
     * Store a newly created ZonePrice in storage.
     *
     * @param CreateZonePriceRequest $request
     *
     * @return Response
     */
    public function store(CreateZonePriceRequest $request)
    {
        $input = $request->all();

        $zonePrice = $this->zonePriceRepository->create($input);

        Flash::success('ZonePrice saved successfully.');

        return redirect(route('admin.zonePrice.zonePrices.index'));
    }

    /**
     * Display the specified ZonePrice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $zonePrice = $this->zonePriceRepository->findWithoutFail($id);

        if (empty($zonePrice)) {
            Flash::error('ZonePrice not found');

            return redirect(route('zonePrices.index'));
        }

        return view('admin.zonePrice.zonePrices.show')->with('zonePrice', $zonePrice);
    }

    /**
     * Show the form for editing the specified ZonePrice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $zonePrice = $this->zonePriceRepository->findWithoutFail($id);

        if (empty($zonePrice)) {
            Flash::error('ZonePrice not found');

            return redirect(route('zonePrices.index'));
        }

        return view('admin.zonePrice.zonePrices.edit')->with('zonePrice', $zonePrice);
    }

    /**
     * Update the specified ZonePrice in storage.
     *
     * @param  int              $id
     * @param UpdateZonePriceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateZonePriceRequest $request)
    {
        $zonePrice = $this->zonePriceRepository->findWithoutFail($id);

        

        if (empty($zonePrice)) {
            Flash::error('ZonePrice not found');

            return redirect(route('zonePrices.index'));
        }

        $zonePrice = $this->zonePriceRepository->update($request->all(), $id);

        Flash::success('ZonePrice updated successfully.');

        return redirect(route('admin.zonePrice.zonePrices.index'));
    }

    /**
     * Remove the specified ZonePrice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.zonePrice.zonePrices.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ZonePrice::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.zonePrice.zonePrices.index'))->with('success', Lang::get('message.success.delete'));

       }

}
