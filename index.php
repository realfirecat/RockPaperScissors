<?php
/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 04.03.2019
 * Time: 12:17
 */
$view = new \TYPO3Fluid\Fluid\View\TemplateView();
$paths = $view->getTemplatePaths();
$paths->setTemplatePathAndFilename(__DIR__ . '/html/index.html');