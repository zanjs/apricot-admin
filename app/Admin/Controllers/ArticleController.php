<?php

namespace App\Admin\Controllers;

use App\User;
use App\Models\Category;
use App\Models\Template;
use App\Models\Article;
use App\Models\Tag;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticleController extends Controller
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

            $content->header('Article');
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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title()->editable();
            // $grid->description()->editable('textarea');
            $grid->tags()->value(function ($tags) {
                $tags = array_map(function ($tags) {
                    return "<span class='label label-warning'>{$tags['title']}</span>";
                }, $tags);
                return join('&nbsp;', $tags);
            });
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            // $table->integer('category_id');
           
            // $table->string('thumb');
            // $table->string('tags');
            // $table->text('description')->nullable();
            // $table->text('body')->nullable();
            // $table->integer('template_id');
            // $table->integer('user_id')->unsigned();

            $form->display('id', 'ID');
            $form->text('title');

            $form->select('category_id')->options(function ($id) {
                $category = Category::find($id);

                if ($category) {
                    return [$category->id => $category->title];
                }
            })->ajax('/api/categoryes');

            
            $form->select('template_id')->options(

                Template::pluck('title', 'id')

            )->load('template', '/api/templates');

            
            $form->multipleSelect('tags')->options(Tag::all()->pluck('title', 'id'));
            // $form->multipleSelect('tags_id')->options(Tag::all()->pluck('title', 'id'));

            $form->select('user_id')->options(function ($id) {
                $user = User::find($id);

                if ($user) {
                    return [$user->id => $user->name];
                }
            })->ajax('/api/users');
            
            $form->image('thumb');
            $form->text('description');
            $form->editor('body');
            $form->switch('active');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
