<?php

namespace Slowlyo\TencentMapSelection\Form;

use Dcat\Admin\Form\Field;

/**
 * 腾讯地图选点
 */
class TencentMap extends Field
{
    protected $view = 'slowlyo.dcat-tencent-map-selection::tencent-map';

    protected static $js = [
        '@extension/slowlyo/tencent-map-selection/js/layui.js',
        '@extension/slowlyo/tencent-map-selection/js/Vue.js'
    ];

    protected static $css = [
        '@extension/slowlyo/tencent-map-selection/css/layui.css'
    ];
}
