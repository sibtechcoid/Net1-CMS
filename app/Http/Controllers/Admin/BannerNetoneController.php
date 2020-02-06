<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateBannerNetoneRequest;
use App\Http\Requests\UpdateBannerNetoneRequest;
use App\Repositories\BannerNetoneRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use App\Models\BannerNetone;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BannerNetoneController extends InfyOmBaseController
{
    /** @var  BannerNetoneRepository */
    private $bannerNetoneRepository;

    public function __construct(BannerNetoneRepository $bannerNetoneRepo)
    {
        $this->bannerNetoneRepository = $bannerNetoneRepo;
    }

    /**
     * Display a listing of the BannerNetone.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->bannerNetoneRepository->pushCriteria(new RequestCriteria($request));
        $bannerNetones = $this->bannerNetoneRepository->all();
        return view('admin.bannerNetones.index')
            ->with('bannerNetones', $bannerNetones);
    }

    /**
     * Show the form for creating a new BannerNetone.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.bannerNetones.create');
    }

    /**
     * Store a newly created BannerNetone in storage.
     *
     * @param CreateBannerNetoneRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_name' => 'required',
            'banner_picture' => 'required|image',
            'banner_order' => 'numeric'
        ]);

        try {
            $banner = new BannerNetone;
            $banner->banner_name = $request->banner_name;
            $path = $request->file('banner_picture')->store('public/banners');
            $banner->banner_picture = $path;
            $banner->banner_url = $request->banner_url;
            $banner->banner_order = $request->banner_order;
    
            $banner->save();
        } catch (\Exception $exception) {
            dd($exception);exit;
        }

        Flash::success('BannerNetone saved successfully.');

        return redirect(route('admin.bannerNetones.index'));
    }

    /**
     * Display the specified BannerNetone.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bannerNetone = $this->bannerNetoneRepository->findWithoutFail($id);

        if (empty($bannerNetone)) {
            Flash::error('BannerNetone not found');

            return redirect(route('bannerNetones.index'));
        }

        return view('admin.bannerNetones.show')->with('bannerNetone', $bannerNetone);
    }

    /**
     * Show the form for editing the specified BannerNetone.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bannerNetone = $this->bannerNetoneRepository->findWithoutFail($id);

        if (empty($bannerNetone)) {
            Flash::error('BannerNetone not found');

            return redirect(route('bannerNetones.index'));
        }

        return view('admin.bannerNetones.edit')->with('bannerNetone', $bannerNetone);
    }

    /**
     * Update the specified BannerNetone in storage.
     *
     * @param  int              $id
     * @param UpdateBannerNetoneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerNetoneRequest $request)
    {
        $bannerNetone = $this->bannerNetoneRepository->findWithoutFail($id);

        

        if (empty($bannerNetone)) {
            Flash::error('BannerNetone not found');

            return redirect(route('bannerNetones.index'));
        }

        $bannerNetone = $this->bannerNetoneRepository->update($request->all(), $id);

        Flash::success('BannerNetone updated successfully.');

        return redirect(route('admin.bannerNetones.index'));
    }

    /**
     * Remove the specified BannerNetone from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function getModalDelete($id = null)
    {
        $error = '';
        $model = '';
        $confirm_route =  route('admin.bannerNetones.delete',['id'=>$id]);
        return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    }

    public function getDelete($id = null)
    {
        $banner = BannerNetone::find($id);
        $deleted_picture = Storage::delete($banner->banner_picture);
        if($deleted_picture) {
            $banner->destroy($id);
        }

        // Redirect to the group management page
        return redirect(route('admin.bannerNetones.index'))->with('success', Lang::get('message.success.delete'));

    }

}
