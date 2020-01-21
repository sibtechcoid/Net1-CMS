<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    public function index()
    {
        $banners = new Banner;
        $response['banners'] = $banners->get();
        $response['code'] = 200;

        return response()->json($response);
    }

    public function show(Banner $banner)
    {
        $response['banner'] = $banner->first();
        $response['code'] = 200;
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_name' => 'required',
            'banner_picture' => 'required|image',
            'banner_url' => 'required',
            'banner_order' => 'required|unique:banners'
        ]);

        try {
            $banner = new Banner;
            $banner->banner_name = $request->banner_name;
            $path = $request->file('banner_picture')->store('banners');
            $banner->banner_picture = $path;
            $banner->banner_url = $request->banner_url;
            $banner->banner_order = $request->banner_order;

            $banner->save();

            $response['message'] = 'New Banner added.';
            $response['code'] = 200;
        }
        catch (\Exception $e) {
//            echo $e;exit;
            $custom_error = ValidationException::withMessages([
               'internal_server' => ['Failed to add new banner. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }

        return response()->json($response);
    }

//     public function update(Request $request, Banner $banner)
//     {
//         $request->validate([
//             'banner_name' => 'required',
//             'banner_picture' => 'image',
//             'banner_url' => 'required',
//             'banner_order' => 'required|unique:banners'
//         ]);
//         try {
//            $banner = new Banner;
//                echo $request->
//            $banner->save();
//
//             $response['message'] = 'Banner is updated.';
//             $response['code'] = 200;
//         }
//         catch (\Exception $e) {
//             $custom_error = ValidationException::withMessages([
//                 'internal_server' => ['Failed to update banner. Try again in a few moment.'],
//             ]);
//             $response['message'] = $custom_error->getMessage();
//             $response['errors'] = $custom_error->errors();
//             $response['code'] = 500;
//         }
//         return response()->json($response);
//     }storage_path('app/banners/1ys8K0ThAQkT7anQDN3TY15PL3PaqIoMoPRRjEC6.jpeg')

    // public function destroy()
    // {

    // }

    public function getBanner($id = null)
    {
        $banner = Banner::where('id', '=', $id);
        if($banner->count() > 0) {
            $banner = $banner->first();
            $image = storage_path('app/'.$banner['banner_picture']);
            return response()->file($image);
        }
        else {
            $custom_error = ValidationException::withMessages([
                 'banner_picture' => ['Banner picture is not found.'],
             ]);
             $response['message'] = $custom_error->getMessage();
             $response['errors'] = $custom_error->errors();
             $response['code'] = 404;
             return response()->json($response);
        }
    }
}
