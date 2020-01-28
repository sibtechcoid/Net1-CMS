<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateDevicesNetOneRequest;
use App\Http\Requests\UpdateDevicesNetOneRequest;
use App\Repositories\DevicesNetOneRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\DevicesNetOne;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DevicesNetOneController extends InfyOmBaseController
{
    /** @var  DevicesNetOneRepository */
    private $devicesNetOneRepository;

    public function __construct(DevicesNetOneRepository $devicesNetOneRepo)
    {
        $this->devicesNetOneRepository = $devicesNetOneRepo;
    }

    /**
     * Display a listing of the DevicesNetOne.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->devicesNetOneRepository->pushCriteria(new RequestCriteria($request));
        $devicesNetOnes = $this->devicesNetOneRepository->all();
        return view('admin.devicesNetOnes.index')
            ->with('devicesNetOnes', $devicesNetOnes);
    }

    /**
     * Show the form for creating a new DevicesNetOne.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.devicesNetOnes.create');
    }

    /**
     * Store a newly created DevicesNetOne in storage.
     *
     * @param CreateDevicesNetOneRequest $request
     *
     * @return Response
     */
    public function store(CreateDevicesNetOneRequest $request)
    {
        $input = $request->all();

        $devicesNetOne = $this->devicesNetOneRepository->create($input);

        Flash::success('DevicesNetOne saved successfully.');

        return redirect(route('admin.devicesNetOnes.index'));
    }

    /**
     * Display the specified DevicesNetOne.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devicesNetOne = $this->devicesNetOneRepository->findWithoutFail($id);

        if (empty($devicesNetOne)) {
            Flash::error('DevicesNetOne not found');

            return redirect(route('devicesNetOnes.index'));
        }

        return view('admin.devicesNetOnes.show')->with('devicesNetOne', $devicesNetOne);
    }

    /**
     * Show the form for editing the specified DevicesNetOne.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devicesNetOne = $this->devicesNetOneRepository->findWithoutFail($id);

        if (empty($devicesNetOne)) {
            Flash::error('DevicesNetOne not found');

            return redirect(route('devicesNetOnes.index'));
        }

        return view('admin.devicesNetOnes.edit')->with('devicesNetOne', $devicesNetOne);
    }

    /**
     * Update the specified DevicesNetOne in storage.
     *
     * @param  int              $id
     * @param UpdateDevicesNetOneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDevicesNetOneRequest $request)
    {
        $devicesNetOne = $this->devicesNetOneRepository->findWithoutFail($id);

        

        if (empty($devicesNetOne)) {
            Flash::error('DevicesNetOne not found');

            return redirect(route('devicesNetOnes.index'));
        }

        $devicesNetOne = $this->devicesNetOneRepository->update($request->all(), $id);

        Flash::success('DevicesNetOne updated successfully.');

        return redirect(route('admin.devicesNetOnes.index'));
    }

    /**
     * Remove the specified DevicesNetOne from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.devicesNetOnes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = DevicesNetOne::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.devicesNetOnes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
