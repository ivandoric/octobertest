<?php namespace Rahman\BlogTags;

use System\Classes\PluginBase;
use RainLab\Blog\Models\Post as PostModel;
use RainLab\Blog\Controllers\Posts as PostsController;

/**
 * BlogTags Plugin Information File
 */
class Plugin extends PluginBase
{

    // required plugins
    public $require = ['RainLab.Blog'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'BlogTags',
            'description' => 'Blog tags for rainlab.blog plugin',
            'author'      => 'Surahman',
            'icon'        => 'icon-tags'
        ];
    }

    /**
     * Register form widgets
     *
     * @return array
     */
    public function registerFormWidgets()
    {
        return [
            'Rahman\BlogTags\FormWidgets\Tagbox' => [
                'label' => 'Tag box field',
                'code'  => 'tagbox'
            ]    
        ];
    }

    /**
     * Register components
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Rahman\BlogTags\Components\Tags'         => 'tags',
            'Rahman\BlogTags\Components\RelatedPosts' => 'relatedPosts',
            'Rahman\BlogTags\Components\SearchPosts'  => 'searchPosts'
        ];
    }

    /**
     * Extend rainlab.blog plugin
     *
     * @return void
     */
    public function boot()
    {
        /**
         * create relationship
         */
        PostModel::extend(function($model) {
            $model->belongsToMany['tags'] = ['Rahman\BlogTags\Models\Tag', 'table' => 'rahman_blogtags_posts_tags'];
        });

        /**
         * extend Rainlab\Blog\Controllers\Post
         * add tag form widget
         */
        PostsController::extendFormFields(function($widget, $model, $context) {
            if (! $model instanceof \Rainlab\Blog\Models\Post) 
                return;

            $widget->addSecondaryTabFields([
                'tags' => [
                    'Label' => 'Tags box',
                    'type'  => 'Rahman\BlogTags\FormWidgets\Tagbox',
                    'tab'   => 'Tags'
                ]
            ]);
        });
    }

}
