<?php

namespace Bridge\Shortcodes\Lib;

use Bidge\Shortcodes\InteractiveIconShowcaseItem\InteractiveIconShowcaseItem;
use Bridge\Shortcodes\AdvancedCallToAction\AdvancedCallToAction;
use Bridge\Shortcodes\AdvancedPricingTable\AdvancedPricingTable;
use Bridge\Shortcodes\AdvancedTab\AdvancedTab;
use Bridge\Shortcodes\AdvancedTabs\AdvancedTabs;
use Bridge\Shortcodes\BlogCarouselTitled\BlogCarouselTitled;
use Bridge\Shortcodes\ButtonV2\ButtonV2;
use Bridge\Shortcodes\CallToActionSection\CallToActionSection;
use Bridge\Shortcodes\CardsSlider\CardsSlider;
use Bridge\Shortcodes\CardsSlider\CardsSliderItem;
use Bridge\Shortcodes\CardsGallery\CardsGallery;
use Bridge\Shortcodes\ComparativeFeaturesTable\ComparativeFeaturesTable;
use Bridge\Shortcodes\CrossfadeImages\CrossfadeImages;
use Bridge\Shortcodes\EllipticalSlider\EllipticalSlider;
use Bridge\Shortcodes\EllipticalSlide\EllipticalSlide;
use Bridge\Shortcodes\ImageWithIconAndText\ImageWithIconAndText;
use Bridge\Shortcodes\InfoCard\InfoCard;
use Bridge\Shortcodes\InfoCardWithIcon\InfoCardWithIcon;
use Bridge\Shortcodes\InteractiveIconShowcase\InteractiveIconShowcase;
use Bridge\Shortcodes\ItemShowcase\ItemShowcase;
use Bridge\Shortcodes\ItemShowcase\ItemShowcaseListItem;
use Bridge\Shortcodes\GradientIconWithText\GradientIconWithText;
use Bridge\Shortcodes\PricingCalculator\PricingCalculator;
use Bridge\Shortcodes\SlidingImageHolder\SlidingImageHolder;
use Bridge\Shortcodes\SpecificationList\SpecificationList;
use Bridge\Shortcodes\NumberedProcess\NumberedProcess;
use Bridge\Shortcodes\NumberedProcessItem\NumberedProcessItem;
use Bridge\Shortcodes\Accordion\Accordion;
use Bridge\Shortcodes\AccordionTab\AccordionTab;
use Bridge\Shortcodes\Workflow\Workflow;
use Bridge\Shortcodes\WorkflowItem\WorkflowItem;


/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 *
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new AdvancedCallToAction());
		$this->addShortcode(new AdvancedPricingTable());
		$this->addShortcode(new AdvancedTabs());
		$this->addShortcode(new AdvancedTab());
		$this->addShortcode(new BlogCarouselTitled());
		$this->addShortcode(new ButtonV2());
		$this->addShortcode(new CallToActionSection());
		$this->addShortcode(new CardsSlider());
        $this->addShortcode(new CardsSliderItem());
        $this->addShortcode(new CardsGallery());
        $this->addShortcode(new ComparativeFeaturesTable());
        $this->addShortcode(new CrossfadeImages());
        $this->addShortcode(new EllipticalSlider());
        $this->addShortcode(new EllipticalSlide());
		$this->addShortcode(new GradientIconWithText());
		$this->addShortcode(new ImageWithIconAndText());
		$this->addShortcode(new InfoCard());
		$this->addShortcode(new InfoCardWithIcon());
		$this->addShortcode(new InteractiveIconShowcase());
		$this->addShortcode(new InteractiveIconShowcaseItem());
        $this->addShortcode(new ItemShowcase());
        $this->addShortcode(new ItemShowcaseListItem());
        $this->addShortcode(new PricingCalculator());
        $this->addShortcode(new SpecificationList());
        $this->addShortcode(new SlidingImageHolder());
        $this->addShortcode(new NumberedProcess());
        $this->addShortcode(new NumberedProcessItem());
        $this->addShortcode(new Accordion());
        $this->addShortcode(new AccordionTab());
        $this->addShortcode(new Workflow());
        $this->addShortcode(new WorkflowItem());

	}

	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}

	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();