<?php namespace Watchlearn\Movies\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Config;
use Watchlearn\Movies\Models\Actor;

class ActorBox extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name'        => 'Actorbox field',
            'description' => 'Field for adding actors'
        ];
    }

    /**
     * render the form widget
     */
    public function render() {
        $this->prepareVars();
        return $this->makePartial('widget');
    }

    /**
     * prepare the variables
     *
     * @return void
     */
    public function prepareVars()
    {
        $this->vars['id'] = $this->model->id;
        $this->vars['actors'] = Actor::all()->lists('full_name', 'id');
        $this->vars['field'] = $this->formField;
        $this->vars['selectedValues'] = $this->getLoadValue();
    }
    

    /**
     * load assets widgets
     */
    public function loadAssets()
    {
        $this->addCss('css/select2.css');
        $this->addJs('js/select2.js');
    }

    /**
     * get tag id if exists or create it if not exists
     *
     * @return array
     */
    public function getSaveValue($value)
    {
        $tags = explode(",", implode(",", $value));
        dd($tags);
        $ids = [];

        foreach ($tags as $name) {

            $ids[] = $name;
        }

        return $ids;
    }
    
}
