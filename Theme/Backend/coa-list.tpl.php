<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View $this
 */
$accounts = $this->data['accounts'];

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('COA'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('Account'); ?>
                    <td class="wf-100"><?= $this->getHtml('Description'); ?>
                <tbody>
                <?php $c = 0;
                foreach ($accounts as $key => $value) : ++$c;
                    $url = UriFactory::build('{/base}/accounting/coa/view?{?}&id=' . $value->id); ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->code); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getL11n()); ?></a>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
                    <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
