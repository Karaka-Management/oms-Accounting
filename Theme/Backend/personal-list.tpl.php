<?php

/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\ClientManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\ClientManagement\Models\Client;
use phpOMS\Uri\UriFactory;

/** @var \phpOMS\Views\View $this */
$accounts = $this->data['accounts'] ?? [];

$type = \reset($accounts) instanceof Client ? 'client' : 'supplier';

echo $this->data['nav']->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Accounts'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table id="iPersonalAccountList" class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                        <label for="iPersonalAccountList-sort-1">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-1">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="iPersonalAccountList-sort-2">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-2">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                        <label for="iPersonalAccountList-sort-3">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-3">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="iPersonalAccountList-sort-4">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-4">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('City'); ?>
                        <label for="iPersonalAccountList-sort-5">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-5">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="iPersonalAccountList-sort-6">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-6">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('Zip'); ?>
                        <label for="iPersonalAccountList-sort-7">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-7">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="iPersonalAccountList-sort-8">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-8">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('Address'); ?>
                        <label for="iPersonalAccountList-sort-9">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-9">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="iPersonalAccountList-sort-10">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-10">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                    <td><?= $this->getHtml('Country'); ?>
                        <label for="iPersonalAccountList-sort-11">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-11">
                            <i class="sort-asc g-icon">expand_less</i>
                        </label>
                        <label for="iPersonalAccountList-sort-12">
                            <input type="radio" name="iPersonalAccountList-sort" id="iPersonalAccountList-sort-12">
                            <i class="sort-desc g-icon">expand_more</i>
                        </label>
                        <label>
                            <i class="filter g-icon">filter_alt</i>
                        </label>
                <tbody>
                <?php $count = 0;
                foreach ($accounts as $key => $value) : ++$count;
                $url = UriFactory::build('{/base}/accounting/' . $type . '/view?{?}&id=' . $value->id);
                ?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('ID', '0', '0'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->number); ?></a>
                    <td data-label="<?= $this->getHtml('Name'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->account->name1); ?> <?= $this->printHtml($value->account->name2); ?></a>
                    <td data-label="<?= $this->getHtml('City'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->mainAddress->city); ?></a>
                    <td data-label="<?= $this->getHtml('Zip'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->mainAddress->postal); ?></a>
                    <td data-label="<?= $this->getHtml('Address'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->mainAddress->address); ?></a>
                    <td data-label="<?= $this->getHtml('Country'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->mainAddress->country); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                    <tr><td colspan="8" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
            </div>
        </section>
    </div>
</div>
