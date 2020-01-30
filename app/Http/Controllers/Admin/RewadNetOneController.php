<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateRewadNetOneRequest;
use App\Http\Requests\UpdateRewadNetOneRequest;
use App\Repositories\RewadNetOneRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\RewadNetOne;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RewadNetOneController extends InfyOmBaseController
{
    /** @var  RewadNetOneRepository */
    private $rewadNetOneRepository;

    public function __construct(RewadNetOneRepository $rewadNetOneRepo)
    {
        $this->rewadNetOneRepository = $rewadNetOneRepo;
    }

    /**
     * Display a listing of the RewadNetOne.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->rewadNetOneRepository->pushCriteria(new RequestCriteria($request));
        $rewadNetOnes = $this->rewadNetOneRepository->all();
        return view('admin.rewadNetOnes.index')
            ->with('rewadNetOnes', $rewadNetOnes);
    }

    /**
     * Show the form for creating a new RewadNetOne.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rewadNetOnes.create');
    }

    /**
     * Store a newly created RewadNetOne in storage.
     *
     * @param CreateRewadNetOneRequest $request
     *
     * @return Response
     */
    public function store(CreateRewadNetOneRequest $request)
    {
        $input = $request->all();

        $rewadNetOne = $this->rewadNetOneRepository->create($input);

        Flash::success('RewadNetOne saved successfully.');

        return redirect(route('admin.rewadNetOnes.index'));
    }

    /**
     * Display the specified RewadNetOne.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rewadNetOne = $this->rewadNetOneRepository->findWithoutFail($id);

        if (empty($rewadNetOne)) {
            Flash::error('RewadNetOne not found');

            return redirect(route('rewadNetOnes.index'));
        }

        return view('admin.rewadNetOnes.show')->with('rewadNetOne', $rewadNetOne);
    }

    /**
     * Show the form for editing the specified RewadNetOne.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rewadNetOne = $this->rewadNetOneRepository->findWithoutFail($id);

        if (empty($rewadNetOne)) {
            Flash::error('RewadNetOne not found');

            return redirect(route('rewadNetOnes.index'));
        }

        return view('admin.rewadNetOnes.edit')->with('rewadNetOne', $rewadNetOne);
    }

    /**
     * Update the specified RewadNetOne in storage.
     *
     * @param  int              $id
     * @param UpdateRewadNetOneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRewadNetOneRequest $request)
    {
        $rewadNetOne = $this->rewadNetOneRepository->findWithoutFail($id);

        

        if (empty($rewadNetOne)) {
            Flash::error('RewadNetOne not found');

            return redirect(route('rewadNetOnes.index'));
        }

        $rewadNetOne = $this->rewadNetOneRepository->update($request->all(), $id);

        Flash::success('RewadNetOne updated successfully.');

        return redirect(route('admin.rewadNetOnes.index'));
    }

    /**
     * Remove the specified RewadNetOne from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.rewadNetOnes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = RewadNetOne::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.rewadNetOnes.index'))->with('success', Lang::get('message.success.delete'));

       }

}
