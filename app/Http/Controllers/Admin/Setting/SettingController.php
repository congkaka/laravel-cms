<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\CoinSetting;
use App\Repositories\BuySellSettingRepository;
use App\Repositories\CoinSettingRepository;
use App\Repositories\EloquentRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ContentSettingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    protected SettingRepository $settingRepository;

    public function __construct(
        SettingRepository $settingRepository
    )
    {
        $this->settingRepository = $settingRepository;
    }

    public function getRepository(): EloquentRepository
    {
        return $this->settingRepository;
    }


    public function contact()
    {
        $setting = $this->settingRepository->getFirst();

        return view('admin.setting.contact', compact('setting'));
    }

    public function bank()
    {
        $setting = $this->settingRepository->getFirst();

        return view('admin.setting.bank', compact('setting'));
    }

    public function image()
    {
        $setting = $this->settingRepository->getFirst();

        return view('admin.setting.image', compact('setting'));
    }

    public function footer()
    {
        $setting = $this->settingRepository->getFirst();

        return view('admin.setting.footer', compact('setting'));
    }

    public function menu()
    {
        $setting = $this->settingRepository->getFirst();

        return view('admin.setting.menu', compact('setting'));
    }

    public function telegram()
    {
        $setting = $this->settingRepository->getFirst();

        return view('admin.setting.telegram', compact('setting'));
    }

    public function updateSiteSetting(Request $request)
    {
        if($request->footer){
            $footer = array_values($request->footer);
            foreach ($footer as $k => $v){
                $item = [];
                for ($i = 0; $i < sizeof($v['name']); $i++){
                    $item[$i]['name'] = $v['name'][$i];
                    $item[$i]['target'] = $v['target'][$i];
                }
                $footer[$k]['item'] = $item;
                unset($footer[$k]['name'], $footer[$k]['target']);
            }
            $request['footer'] = $footer;
        }
        if($request->main_menu){
            $main_menu = $request->main_menu;
            $item = [];

            for ($i = 0; $i < sizeof($main_menu['name']); $i++){
                $item[$i]['name'] = $main_menu['name'][$i];
                $item[$i]['target'] = $main_menu['target'][$i];
            }
            $request['main_menu'] = $item;
        }
        if($request->top_menu){
            $top_menu = $request->top_menu;
            $item = [];
            for ($i = 0; $i < sizeof($top_menu['name']); $i++){
                $item[$i]['name'] = $top_menu['name'][$i];
                $item[$i]['target'] = $top_menu['target'][$i];
            }
            $request['top_menu'] = $item;
        }

        $setting = $this->settingRepository->getFirst();
        if (!$setting) {
            $this->getRepository()->create($request->all());
        } else {
            $this->getRepository()->update($setting->id, $request->all());
        }

        return back();
    }

}
