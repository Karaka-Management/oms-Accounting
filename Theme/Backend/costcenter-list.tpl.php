<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View               $this
 * @var \Modules\Tag\Models\CostCenter[] $costcenter
 */
$costcenter = $this->getData('costcenter');

$previous = empty($costcenter) ? '{/prefix}tag/list' : '{/prefix}tag/list?{?}&id=' . \reset($costcenter)->getId() . '&ptype=p';
$next     = empty($costcenter) ? '{/prefix}tag/list' : '{/prefix}tag/list?{?}&id=' . \end($costcenter)->getId() . '&ptype=n';

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('CostCenters'); ?><i class="fa fa-download floatRight download btn"></i></div>
            <table class="default sticky">
            <thead>
            <tr>
                <td><?= $this->getHtml('Code'); ?>
                <td class="wf-100"><?= $this->getHtml('Name'); ?>
            <tbody>
            <?php $count = 0; foreach ($costcenter as $key => $value) : ++$count;
            $url         = UriFactory::build('{/prefix}tag/single?{?}&id=' . $value->getId()); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Code'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->code); ?></a>
                    <td data-label="<?= $this->getHtml('Name'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->l11n->name); ?></a>
            <?php endforeach; ?>
            <?php if ($count === 0) : ?>
                <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
            <?php endif; ?>
        </table>
        <div class="portlet-foot">
            <a tabindex="0" class="button" href="<?= UriFactory::build($previous); ?>"><?= $this->getHtml('Previous', '0', '0'); ?></a>
            <a tabindex="0" class="button" href="<?= UriFactory::build($next); ?>"><?= $this->getHtml('Next', '0', '0'); ?></a>
        </div>
    </div>
</div>
