<?php

namespace Modules\Socials\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\Socials\Entities\Social;

class SocialsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Social::all();

        return view('socials::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('socials::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $item = Social::create([
//                'lang' => $request->lang,
                'brand_id' => $request->brand_id,
                'name' => $request->name,
                'url' => $request->url,
                'f_icon' => $request->f_icon,
                'i_icon' => (isset($request->i_icon)?file_store($request->i_icon, 'assets/uploads/photos/socials/', 'icon_'):null)
            ]);

            return redirect()->route('socials.index')->with('flash_message', 'با موفقیت افزوده شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('socials::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Social $social)
    {
        return view('socials::edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Social $social)
    {
        try {

//            $social->lang = $request->lang;
            if ($request->brand_id) {
                $social->brand_id = $request->brand_id;
            }
            $social->name = $request->name;
            $social->url = $request->url;
            $social->f_icon = $request->f_icon;
            if (isset($request->i_icon)){
                if ($social->i_icon){
                    File::delete($social->i_icon);
                }
                $social->i_icon = file_store($request->i_icon, 'assets/uploads/photos/socials/', 'icon_');
            }

            $social->save();

            return redirect()->route('socials.index')->with('flash_message', 'بروزرسانی با موفقیت انجام شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Social $social)
    {
        try {
            $social->delete();

            return redirect()->route('socials.index')->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
