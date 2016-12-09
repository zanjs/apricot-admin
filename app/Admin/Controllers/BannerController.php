<?php

namespace App\Admin\Controllers;

use App\Models\Banner;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BannerController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Banner::class, function (Grid $grid) {
            $grid->model()->orderBy('updated_at', 'desc');

            // $grid->id('ID')->sortable();
            $grid->title()->editable();
            $grid->created_at();
            $grid->updated_at()->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Banner::class, function (Form $form) {
            // $table->string('url');
            // $table->integer('category_id');
            // $table->integer('type_id');
            // $table->boolean('active')->default(0);
            // $table->string('thumb');
            // $table->string('bg_color');
            // $table->string('bg_img');
            // $table->text('description')->nullable();
            $form->display('id', 'ID');
            $form->text('name');
            $form->text('title');
            $form->text('category_id');
            $form->text('type_id');
            $form->url('url');
            $form->color('bg_color', '背景色');
            $form->image('thumb','缩略图');
            $form->image('bg_img','背景图');
            $form->switch('active', '开关');
            $form->number('sort', '排序');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
