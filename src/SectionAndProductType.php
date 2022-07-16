<?php

namespace wmd\sectionandproducttype;

use Craft;
use yii\base\Event;
use craft\base\Plugin;
use craft\services\Fields;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use wmd\sectionandproducttype\fields\SectionField;
use wmd\sectionandproducttype\fields\TagGroupField;
use wmd\sectionandproducttype\fields\ProductTypeField;


class SectionAndProductType extends Plugin
{
    /**
     * @var SectionAndProductType
     */
    public static $plugin;

    /**
     * @var string
     */
    public $schemaVersion = '1.1.1';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = SectionField::class;
                $event->types[] = ProductTypeField::class;
                $event->types[] = TagGroupField::class;
            }
        );

        Craft::info(
            Craft::t(
                'section-and-product-type',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

}
