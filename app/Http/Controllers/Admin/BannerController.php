<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Banner;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Curl;
use App\Helpers\ApiUrl;

class BannerController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the Banner.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $banner = new Banner();
        $response = $banner->getAllBanners();

        return view('admin.banners.index')
            ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for creating a new Banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.banners.create')
            ->with('userInfo', User::getSlightInfo());
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param CreateBannerRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'banner_name' => 'required',
            'banner_picture' => 'required|image',
            'banner_url' => 'required',
            'banner_order' => 'required'
        ]);
        var_dump($fields);exit;
        $banner = new Banner();
        $response = $banner->addBanner($fields);

        var_dump($response);exit;

        return view('admin.banners.index')
            ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Display the specified Banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banner = new Banner();
        $res = $banner->getBanner($id);
        $response = $res['banner'];
//        $response['url'] = ApiUrl::$url.'getDisplayBanner/'.$id;
        $image = $banner->getBannerPicture($id);
//        var_dump($response);exit;
        return view('admin.banners.show')
            ->with('response', $response)
            ->with('banner', $banner)
            ->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for editing the specified Banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('admin.banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified Banner in storage.
     *
     * @param  int              $id
     * @param UpdateBannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerRequest $request)
    {
        $banner = $this->bannerRepository->findWithoutFail($id);



        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $banner = $this->bannerRepository->update($request->all(), $id);

        Flash::success('Banner updated successfully.');

        return redirect(route('admin.banners.index'));
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.banners.banners.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Banner::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.banners.index'))->with('success', Lang::get('message.success.delete'));

       }

}
