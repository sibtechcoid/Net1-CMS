<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateRewardRequest;
use App\Http\Requests\UpdateRewardRequest;
use App\Repositories\RewardRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Reward;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Excel\Exports\RewardsExport;
use App\Excel\Imports\RewardsImport;
use Illuminate\Validation\ValidationException;

class RewardController extends InfyOmBaseController
{
    /** @var  RewardRepository */
    private $rewardRepository;

    public function __construct(RewardRepository $rewardRepo)
    {
        $this->rewardRepository = $rewardRepo;
    }

    /**
     * Display a listing of the Reward.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->rewardRepository->pushCriteria(new RequestCriteria($request));
        $rewards = $this->rewardRepository->all();
        return view('admin.rewards.index')
            ->with('rewards', $rewards);
    }

    /**
     * Show the form for creating a new Reward.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.rewards.create');
    }

    /**
     * Store a newly created Reward in storage.
     *
     * @param CreateRewardRequest $request
     *
     * @return Response
     */
    public function store(CreateRewardRequest $request)
    {
        $input = $request->all();

        $reward = $this->rewardRepository->create($input);

        Flash::success('Reward saved successfully.');

        return redirect(route('admin.rewards.index'));
    }

    /**
     * Display the specified Reward.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reward = $this->rewardRepository->findWithoutFail($id);

        if (empty($reward)) {
            Flash::error('Reward not found');

            return redirect(route('rewards.index'));
        }

        return view('admin.rewards.show')->with('reward', $reward);
    }

    /**
     * Show the form for editing the specified Reward.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reward = $this->rewardRepository->findWithoutFail($id);

        if (empty($reward)) {
            Flash::error('Reward not found');

            return redirect(route('rewards.index'));
        }

        return view('admin.rewards.edit')->with('reward', $reward);
    }

    /**
     * Update the specified Reward in storage.
     *
     * @param  int              $id
     * @param UpdateRewardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRewardRequest $request)
    {
        $reward = $this->rewardRepository->findWithoutFail($id);

        

        if (empty($reward)) {
            Flash::error('Reward not found');

            return redirect(route('rewards.index'));
        }

        $reward = $this->rewardRepository->update($request->all(), $id);

        Flash::success('Reward updated successfully.');

        return redirect(route('admin.rewards.index'));
    }

    /**
     * Remove the specified Reward from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.rewards.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Reward::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.rewards.index'))->with('success', Lang::get('message.success.delete'));

       }

    /**
     * Method to import reward list from excel file.xlsx
     * @author: Roy
     * 
     */
    public function uploadAsExcel(Request $request) {
        $request->validate([
            'rewardExcel' => 'required'
        ]);
        try {
            $import = Excel::import(new RewardsImport, $request->file('rewardExcel'));
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $exception) {
            \DB::rollBack();
            $failures = $exception->failures();
            $error = [];
            foreach ($failures as $failure) {
                $error['row'] = $failure->row(); // row that went wrong
                $error['attribute'] = $failure->attribute(); // either heading key (if using heading row concern) or column index
                dd($failure);
                foreach ($failure->error() as $value) {
                    $error['error'] = $value;
                }
            }
            // dd($error);
            // exit;
            return back()->withErrors(['error' => $error]);
            // echo get_class($exception) ."<br>";
            // echo $exception->getCode() ."<br>";
            // echo $exception->getMessage();
        }
        return back();
    }

    /**
     * Method to export reward list from database into downloadable excel file.xlsx
     * @author: Roy
     * 
     */
    public function downloadAsExcel() {
        return Excel::download(new RewardsExport, 'rewards.xlsx');
    }

}
