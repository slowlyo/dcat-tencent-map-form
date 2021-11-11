<?php

namespace Slowlyo\TencentMapSelection;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    // 返回表单弹窗标题
    public function title()
    {
        return 'set tencent map key';
    }

    public function form()
    {
        // 定义表单字段
        $this->text('slowlyo-tencent-map-key', 'Key')->required();
    }
}
