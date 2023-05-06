<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="default sticky">
        <caption><?= $this->getHtml('Journal'); ?><i class="fa fa-download floatRight download btn"></i></caption>
        <thead>
        <tr>
            <td><?= $this->getHtml('ID', '0', '0'); ?>
            <td class="wf-100"><?= $this->getHtml('Name'); ?>
        <tbody>
        <?php $c = 0; foreach ([] as $key => $value) : ++$c;
        $url     = \phpOMS\Uri\UriFactory::build('{/base}/admin/group/settings?{?}&id=' . $value->id); ?>
        <tr>
            <td><a href="<?= $url; ?>"><?= $value->id; ?></a>
            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
            <td>
            <td>
            <td>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
        <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
    </table>
</div>
