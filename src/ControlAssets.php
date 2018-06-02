<?php

declare(strict_types=1);

namespace WebChemistry\ControlAssets;

use Nette\Bridges\ApplicationLatte\ILatteFactory;
use Nette\Http\IRequest;

class ControlAssets implements IControlAssets {

	const CSS = true, JS = false;

	/** @var string */
	private $result = '';

	/** @var bool */
	private $type;

	/** @var ILatteFactory */
	private $latteFactory;

	/** @var string */
	private $basePath;

	public function __construct(bool $type, ILatteFactory $latteFactory, IRequest $request) {
		$this->type = $type;
		$this->latteFactory = $latteFactory;
		$this->basePath = $request->getUrl()->getBasePath();
	}

	public function add(string $link): void {
		$link = $this->basePath . $link;
		if ($this->type === self::CSS) {
			$this->result .= "<link rel=\"stylesheet\" href=\"$link\">\n";
		} else {
			$this->result .= "<script src=\"$link\"></script>\n";
		}
	}

	public function addContent(string $content): void {
		if ($this->type === self::CSS) {
			$this->result .= "<style>\n";
			$this->result .= $content;
			$this->result .= "</style>\n";
		} else {
			$this->result .= "<script>\n";
			$this->result .= $content;
			$this->result .= "</script>";
		}
	}

	public function template(string $template, array $params = []): void {
		$engine = $this->latteFactory->create();

		$this->result .= $engine->renderToString($template, $params) . "\n";
	}

	public function toString(): string {
		return $this->result;
	}

}
