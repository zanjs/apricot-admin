

# apricot

// 数据库迁移
// --database   指定数据库连接（下同）
// --force      当处于生产环境时强制执行，不询问（下同）
// --path       指定单独迁移文件地址
// --pretend    把将要运行的 SQL 语句打印出来（下同）
// --seed       Seed 任务是否需要被重新运行（下同

```
php artisan migrate [--database[="..."]] [--force] [--path[="..."]] [--pretend] [--seed]
```


// 创建一个新的 Eloquent 模型类

```
php artisan make:model name
```

```
php artisan make:model Models\Post
php artisan make:model Models\Article
php artisan make:migration create_article_table 
```


createarticle_table

```
public function up()  
{
    Schema::create('articles', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('title');
        $table->integer('category_id');
        $table->boolean('active')->default(0);
        $table->string('thumb');
        $table->string('tags_id');
        $table->text('description')->nullable();
        $table->text('body')->nullable();
        $table->integer('template_id');
        $table->integer('user_id')->unsigned();
        $table->timestamps();
    });
}
```


```
php artisan migrate  
```

```

php artisan admin:make ArticleController --model=App\\Models\\Article

// 在windows系统中
php artisan admin:make ArticleController --model=App\Models\Article

```

### Category

```
php artisan make:model Models\Category
php artisan make:migration create_category_table 
```


```
public function up()
    {
        Schema::create('categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->integer('pid');
            $table->timestamps();
        });
    }
```

```
php artisan migrate 
php artisan admin:make CategoryController --model=App\Models\Category
```

### Tag

```
php artisan make:model Models\Tag
php artisan make:migration create_tag_table 
```

```
public function up()
    {
        Schema::create('tags', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }
```


```
php artisan migrate 
php artisan admin:make TagController --model=App\Models\Tag
```

### Template 

```
php artisan make:model Models\Template
php artisan make:migration create_template_table 
```

```
public function up()
    {
        Schema::create('templates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('vpath');
            $table->timestamps();
        });
    }
```


```
php artisan migrate 
php artisan admin:make TemplateController --model=App\Models\Template
```


使用eloquent的查询做过滤 - 多对多关系组合查询

```
$grid->filter(function ($filter) {

    $filter->where(function ($query) {

        $input = $this->input;

        $query->whereHas('tags', function ($query) use ($input) {

            $query->where('name', $input);

        })->orWhere('title', 'like', "%$input%");

    }, 'Has tag');
});
```

自定义sql，可以使用$query->whereRaw()来实现

## Api

```
php artisan make:controller Api\UserController
php artisan make:controller Api\CategoryController
php artisan make:controller Api\TemplateController
```

### UserController

```
public function index(Request $request){
        
    $q = $request->input('q');

    return User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
}
```

### CategoryController

```
public function index(Request $request){
        
    $q = $request->input('q');

    return Category::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
}
```

### TemplateController

```
public function index(Request $request){
        
    $q = $request->input('q');

    return Template::where('title', 'like', "%$q%")->paginate(null, ['id', 'title as text']);
}
```


## Banner

```
php artisan make:model Models\Banner
php artisan make:migration create_banner_table
php artisan make:model Models\BannerCategory
php artisan make:migration create_banner_category_table
```

```
php artisan migrate
php artisan admin:make BannerController --model=App\Models\Banner
php artisan admin:make BannerCategoryController --model=App\Models\BannerCategory
```


## Article_Tag

```
php artisan make:model Models\ArticleTag
php artisan make:migration create_article_tag_table
php artisan migrate
```



### SQL

```
SELECT article_id from article_tags 
                 where tag_id in (select tag_id from article_tags where article_id=1)
                   and article_id<>1
```
## Settings

```
php artisan make:model Models\Setting
php artisan make:migration create_setting_table
php artisan admin:make SettingController --model=App\Models\Setting
```


