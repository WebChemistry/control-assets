<?php

declare(strict_types=1);

namespace WebChemistry\ControlAssets;

interface IControlAssetsFactory {

	public function createStylesheet(): IControlAssets;

	public function createJavascript(): IControlAssets;

}
