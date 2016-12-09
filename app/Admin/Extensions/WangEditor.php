<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.editor';

    protected static $css = [
        '/packages/wangEditor-2.1.22/dist/css/wangEditor.min.css',
    ];

    protected static $js = [
        '/packages/wangEditor-2.1.22/dist/js/wangEditor.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

var editor = new wangEditor('{$this->id}');
    editor.config.uploadImgUrl = '/admin/imgs';
     // 仅仅想移除某几个菜单，例如想移除『插入代码』和『全屏』菜单：
     // 其中的 wangEditor.config.menus 可获取默认情况下的菜单配置
     editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
         if (item === 'location') {
             return null;
         }
         
         return item;
     });
    editor.config.uploadParams = {
        _token: Laravel.csrfToken,
        user: Laravel.admin
    };
    editor.config.uploadImgFileName = 'image';
     // 自定义load事件
    editor.config.uploadImgFns.onload = function (resultText, xhr) {
        // resultText 服务器端返回的text
        // xhr 是 xmlHttpRequest 对象，IE8、9中不支持
        console.log(resultText);
        var json = JSON.parse(resultText);
        // 上传图片时，已经将图片的名字存在 editor.uploadImgOriginalName
        var originalName = editor.uploadImgOriginalName || '';  

        // 如果 resultText 是图片的url地址，可以这样插入图片：
        editor.command(null, 'insertHtml', '<img src="' + json.src + '" alt="' + originalName + '" style="max-width:100%;"/>');
        // 如果不想要 img 的 max-width 样式，也可以这样插入：
        // editor.command(null, 'InsertImage', resultText);
    };
    editor.create();

EOT;
        return parent::render();

    }
}