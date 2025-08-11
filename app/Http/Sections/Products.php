<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Section;
use App\Models\Category;
use App\Helpers\SlugHelper;

/**
 * Class Products
 *
 * @property \App\Models\Product $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Products extends Section implements Initializable
{
    use \SleepingOwl\Admin\Traits\Assets;

    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Товары';

    /**
     * @var string
     */
    protected $alias;

    public function __construct(\Illuminate\Contracts\Foundation\Application $app, $class)
    {
        parent::__construct($app, $class);

        $this->initializePackage();
    }

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->includePackage();

        $this->addToNavigation()->setIcon('fas fa-list');

        $this->addStyle('custom-css', asset('css/admin.css'));
        $this->addScript('custom-js', asset('js/admin.js'));
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', '#')->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::link('name', 'Название', 'slug')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('name', 'like', '%'.$search.'%')
                        ->orWhere('created_at', 'like', '%'.$search.'%')
                    ;
                })
                ->setOrderable(function($query, $direction) {
                    $query->orderBy('created_at', $direction);
                }),
            AdminColumn::text('price', 'Цена')
                ->setWidth('160px'),
        ];

        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

        $display->setColumnFilters([
            AdminColumnFilter::select()
                ->setModelForOptions(\App\Models\Product::class, 'name')
                ->setLoadOptionsQueryPreparer(function($element, $query) {
                    return $query;
                })
                ->setDisplay('name')
                ->setColumnName('name')
                ->setPlaceholder('All names')
            ,
        ]);
        $display->getColumnFilters()->setPlacement('card.heading');

        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();

        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('name', 'Название')
                    ->required()
                    ->addValidationRule('max:255'),
                AdminFormElement::select('category_id', 'Категория')
                    ->required()
                    ->setOptions($categories)
                    ->addValidationRule('in:' . implode(',', array_keys($categories))),
                AdminFormElement::text('slug', 'Метка (slug)')
                    ->required()
                    ->addValidationRule('max:255')
                    ->addValidationRule('regex:/^[a-z0-9-_]+$/i')
                    ->unique(),
                AdminFormElement::number('price', 'Цена')
                    ->required()
                    ->addValidationRule('numeric')
                    ->setStep(0.01),
                AdminFormElement::text('image_url', 'Изображение (url)'),
                AdminFormElement::textarea('description', 'Описание'),
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-6')->addColumn([
                AdminFormElement::text('id', 'ID')->setReadonly(true),
            ], 'col-xs-12 col-sm-6 col-md-8 col-lg-6'),
        ])->setHtmlAttribute('class', 'form-product');

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }
}
