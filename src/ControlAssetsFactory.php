<?php

declare(strict_types=1);

namespace WebChemistry\ControlAssets;

use Nette\Bridges\ApplicationLatte\ILatteFactory;

class ControlAssetsFactory implements IControlAssetsFactory {

	/** @var ILatteFactory */
	private $latteFactory;

	public function __construct(ILatteFactory $latteFactory) {
		$this->latteFactory = $latteFactory;
	}

	public function createStylesheet(): IControlAssets {
		return new ControlAssets(ControlAssets::CSS, $this->latteFactory);
	}

	public function createJavascript(): IControlAssets {
		return new ControlAssets(ControlAssets::JS, $this->latteFactory);
	}

}
