<?php

declare(strict_types=1);

namespace WebChemistry\ControlAssets;

interface IControlAssets {

	public function add(string $link): void;

	public function template(string $template): void;

	public function addContent(string $content): void;

	public function toString(): string;

}
