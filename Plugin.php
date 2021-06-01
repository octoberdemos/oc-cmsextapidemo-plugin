<?php namespace October\CmsExtApiDemo;

use Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'October CMS Extensibility API Demo',
            'description' => 'Demonstrates the CMS Extensibility API features.',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-leaf'
        ];
    }


    public function boot() 
    {
        Event::listen('cms.template.extendTemplateSettingsFields', function ($extension, $dataHolder) {
            if ($dataHolder->templateType === 'page') {
                $dataHolder->settings[] = [
                    'property' => 'header_image',
                    'title' => 'Header Image',
                    'type' => 'mediafinder'
                ];
            }
        });

        Event::listen('cms.template.getTemplateToolbarSettingsButtons', function ($extension, $dataHolder) {
            if ($dataHolder->templateType === 'page') {
                $dataHolder->buttons[] = [
                    'button' => 'My Custom Button',
                    'icon' => 'octo-icon-text-emoticons',
                    'popupTitle' => 'My Custom Settings',
                    'useViewBag' => true,
                    'properties' => [
                        [
                            'property' => 'facebookPageUrl',
                            'title' => 'Facebook Page URL',
                            'type' => 'string'
                        ]
                    ]
                ];
            }
        });
    }
}
