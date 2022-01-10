<div id="tencent-map-div" class="{{$viewClass['form-group']}}">
    @php
        $key = \Slowlyo\TencentMapSelection\TencentMapSelectionServiceProvider::setting('slowlyo-tencent-map-key')
    @endphp

    <label class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="input-group">
            <div class="input-group-prepend">
			<span class="input-group-text bg-white rounded-sm">
				<i class="feather icon-map"></i>
			</span>
            </div>
            <input type="text"
                   class="form-control"
                   v-model="latlng1"
                   disabled />
            <input type="hidden"
                   class="form-control"
                   name="{{ $name }}"
                   value="{{ $value }}"
                   v-model="latlng" />
            <div class="input-group-append">
                <button type="button" class="btn btn-primary" v-on:click="openChoose()">选择坐标</button>
            </div>
        </div>

        @if(!$key)
            <div class="text-danger">
                &emsp;* 请在(扩展>设置)中设置腾讯地图key
            </div>
        @endif

        @include('admin::form.help-block')

    </div>
    <div class="disable-div">
        <iframe id="mapPage" width="100%" height="100%"
                src="https://apis.map.qq.com/tools/locpicker?search=1&type=1&key={{ $key }}&referer=myapp">
        </iframe>
    </div>
</div>

{{--引入 Css--}}
{{ admin_css("static/css/layui.css") }}
{{--引入 Js--}}
{{ admin_js("static/js/Vue.js") }}
{{ admin_js("static/layui.js") }}

<script>
    var vue = new Vue({
        el: "#tencent-map-div",
        data: {
            latlng: '',
            latlng1: '',
            now_layer: '',
            old_value: "{{ old($column, $value) }}",
        },
        mounted() {
            console.clear()
            if (this.old_value) {
                this.latlng = this.latlng1 = this.old_value
            }
            console.log(this.old_value)
        },
        methods: {
            openChoose() {
                let that = this
                that.now_layer = layer.open({
                    type: 1,
                    shade: 0.3,
                    title: '选择坐标',
                    maxmin: false,
                    moveOut: false,
                    area: ['800px', '500px'],
                    content: $('#mapPage'),
                    btn: ['确认'],
		    success: function (layero) {
                        // 处理layer 遮罩在content前
                        $('.layui-layer-shade').appendTo(layero.parent())
                    },
                    yes: function () {
                        if (!that.latlng) {
                            layer.msg('未选择坐标')
                            return
                        }
                        layer.close(that.now_layer)
                    },
                })
            },
        },
    })
    window.addEventListener('message', function (event) {
        // 接收位置信息，用户选择确认位置点后选点组件会触发该事件，回传用户的位置信息
        var loc = event.data
        if (loc && loc.module == 'locationPicker') {//防止其他应用也会向该页面post信息，需判断module是否为'locationPicker'
            console.log('location', loc)
            vue.latlng = vue.latlng1 = loc.latlng.lat + ',' + loc.latlng.lng
        }
    }, false)
</script>

<style>
    .disable-div {
        position: absolute;
        top: -99999px;
    }

    #mapPage {
        border: 0;
    }
</style>
