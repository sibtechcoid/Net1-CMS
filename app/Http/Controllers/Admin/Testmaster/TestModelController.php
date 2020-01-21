<?php

namespace App\Http\Controllers\Admin\Testmaster;

use App\Http\Requests;
use App\Http\Requests\Testmaster\CreateTestModelRequest;
use App\Http\Requests\Testmaster\UpdateTestModelRequest;
use App\Repositories\Testmaster\TestModelRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Testmaster\TestModel;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TestModelController extends InfyOmBaseController
{
    /** @var  TestModelRepository */
    private $testModelRepository;

    public function __construct(TestModelRepository $testModelRepo)
    {
        $this->testModelRepository = $testModelRepo;
    }

    /**
     * Display a listing of the TestModel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->testModelRepository->pushCriteria(new RequestCriteria($request));
        $testModels = $this->testModelRepository->all();
        return view('admin.testMaster.testModels.index')
            ->with('testModels', $testModels);
    }

    /**
     * Show the form for creating a new TestModel.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.testMaster.testModels.create');
    }

    /**
     * Store a newly created TestModel in storage.
     *
     * @param CreateTestModelRequest $request
     *
     * @return Response
     */
    public function store(CreateTestModelRequest $request)
    {
        $input = $request->all();

        $testModel = $this->testModelRepository->create($input);

        Flash::success('TestModel saved successfully.');

        return redirect(route('admin.testMaster.testModels.index'));
    }

    /**
     * Display the specified TestModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $testModel = $this->testModelRepository->findWithoutFail($id);

        if (empty($testModel)) {
            Flash::error('TestModel not found');

            return redirect(route('testModels.index'));
        }

        return view('admin.testMaster.testModels.show')->with('testModel', $testModel);
    }

    /**
     * Show the form for editing the specified TestModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $testModel = $this->testModelRepository->findWithoutFail($id);

        if (empty($testModel)) {
            Flash::error('TestModel not found');

            return redirect(route('testModels.index'));
        }

        return view('admin.testMaster.testModels.edit')->with('testModel', $testModel);
    }

    /**
     * Update the specified TestModel in storage.
     *
     * @param  int              $id
     * @param UpdateTestModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestModelRequest $request)
    {
        $testModel = $this->testModelRepository->findWithoutFail($id);

        

        if (empty($testModel)) {
            Flash::error('TestModel not found');

            return redirect(route('testModels.index'));
        }

        $testModel = $this->testModelRepository->update($request->all(), $id);

        Flash::success('TestModel updated successfully.');

        return redirect(route('admin.testMaster.testModels.index'));
    }

    /**
     * Remove the specified TestModel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.testMaster.testModels.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = TestModel::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.testMaster.testModels.index'))->with('success', Lang::get('message.success.delete'));

       }

}
