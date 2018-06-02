<?php

declare(strict_types=1);

namespace WebChemistry\ControlAssets\Latte;

use Latte\CompileException;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;

final class Macros extends MacroSet {

	public function macro(MacroNode $node, PhpWriter $writer, bool $javascript) {
		$words = $node->tokenizer->fetchWords();
		$method = $javascript ? 'getJavascript' : 'getStylesheet';
		if (!$words) {
			throw new CompileException('Missing control name in {control}');
		}
		$name = $writer->formatWord($words[0]);

		return "/* line $node->startLine */ "
			. ($name[0] === '$' ? "if (is_object($name)) \$_tmp = $name; else " : '')
			. '$_tmp = $this->global->uiControl->getComponent(' . $name . '); '
			. ($node->modifiers === ''
				? "\$_tmp->$method();"
				: $writer->write("ob_start(function () {}); \$_tmp->$method(); echo %modify(ob_get_clean());")
			);
	}

}
