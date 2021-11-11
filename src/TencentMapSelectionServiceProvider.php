<?php

namespace Slowlyo\TencentMapSelection;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;

class TencentMapSelectionServiceProvider extends ServiceProvider
{
    protected $js = [
        'js/index.js',
    ];
    protected $css = [
        'css/index.css',
    ];

    public function register()
    {
        //
    }

    public function init()
    {
        parent::init();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tencent-map');
        Admin::booting(function () {
            // 腾讯地图表单组件
            Form::extend('tencentMap', \Slowlyo\TencentMapSelection\Form\TencentMap::class);
        });

    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
