<?php
/**
 * Jingga
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

//echo $this->data['nav']->render();

$footerView = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(25);
$footerView->setPage(1);
$footerView->setResults(1);
?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-body">
                <form>
                    <table class="layout wf-100">
                        <tr>
                            <td><label for="iAccount"><?= $this->getHtml('Account'); ?></label>
                            <td><label for="iContra"><?= $this->getHtml('Account'); ?></label>
                            <td><label for="iCostCenter"><?= $this->getHtml('CostCenter'); ?>
                            <td><label for="iCostObject"><?= $this->getHtml('CostObject'); ?>
                            <td><label for="iDate"><?= $this->getHtml('Date'); ?>
                        <tr>
                            <td><span class="input"><button type="button" id="account-start" formaction="" data-action='[{"type": "popup", "tpl": "entry-list-tpl", "aniIn": "fadeIn", "aniOut": "fadeOut", "stay": 1000}]'><i class="g-icon">book</i>
                                    </button><input type="text" id="iAccount" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" id="contra-start" formaction="" data-action='[{"type": "popup", "tpl": "entry-list-tpl", "aniIn": "fadeIn", "aniOut": "fadeOut", "stay": 1000}]'><i class="g-icon">book</i>
                                </button><input type="text" id="iContra" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="text" id="iCostCenter" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="text" id="iCostObject" min="1" name="id" required></span>
                            <td><input type="datetime-local" id="iDate" min="1" name="id" required>
                        <tr>
                            <td><label for="iAccountType"><?= $this->getHtml('Type'); ?></label>
                            <td><label for="iContraType"><?= $this->getHtml('Type'); ?></label>
                            <td>
                            <td>
                            <td><label for="iDateType"><?= $this->getHtml('Type'); ?></label>
                        <tr>
                            <td><select id="iAccountType" name="">
                                    <option selected>Debit/Credit
                                    <option>Debit
                                    <option>Credit
                                </select>
                            <td><select id="iContraType" name="">
                                    <option selected>Debit/Credit
                                    <option>Debit
                                    <option>Credit
                                </select>
                            <td>
                            <td>
                            <td><select id="iAccountType" name="">
                                    <option selected>Performance date
                                    <option>Invoice date
                                    <option>Posting date
                                </select>
                    </table>
                </form>
            </div>
            <div class="portlet-foot">
                <input type="submit" value="<?= $this->getHtml('Search'); ?>" name="search">
            </div>
        </section>
    </div>
</div>

<div class="box w-100">
    <div class="tabview tab-2">
        <ul class="tab-links">
            <li><label for="c-tab2-1"><?= $this->getHtml('List'); ?></label>
            <li><label for="c-tab2-2"><?= $this->getHtml('Evaluation'); ?></label>
            <li><label for="c-tab2-3"><?= $this->getHtml('Charts'); ?></label>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab2-1" name="tabular-2" checked>
            <div class="tab">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="portlet">
                            <div class="portlet-head"><?= $this->getHtml('Entries'); ?><i class="g-icon download btn end-xs">download</i></div>
                            <div class="slider">
                            <table class="default sticky">
                                <thead>
                                <tr>
                                    <td><?= $this->getHtml('EntryDate'); ?>
                                    <td><?= $this->getHtml('Receipt'); ?>
                                    <td><?= $this->getHtml('Debit'); ?>
                                    <td><?= $this->getHtml('Credit'); ?>
                                    <td class="wf-100"><?= $this->getHtml('Text'); ?>
                                    <td><?= $this->getHtml('Account'); ?>
                                    <td><?= $this->getHtml('ContraAccount'); ?>
                                    <td><?= $this->getHtml('CostCenter'); ?>
                                    <td><?= $this->getHtml('CostObject'); ?>
                                    <td><?= $this->getHtml('ReceiptDate'); ?>
                                    <td><?= $this->getHtml('ExternalVoucher'); ?>
                                    <td><?= $this->getHtml('Creator'); ?>
                                    <td><?= $this->getHtml('Created'); ?>
                                <tbody>
                                <?php $count = 0;
                                foreach ([] as $key => $value) : ++$count; ?>
                                <?php endforeach; ?>
                                <?php if ($count === 0) : ?>
                                <tr>
                                    <td colspan="13" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                        <?php endif; ?>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="radio" id="c-tab2-2" name="tabular-2">
            <div class="tab">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="portlet">
                            <div class="portlet-head"><?= $this->getHtml('Accounts'); ?><i class="g-icon download btn end-xs">download</i></div>
                            <div class="slider">
                            <table class="default sticky">
                                <thead>
                                <tr>
                                    <td><?= $this->getHtml('Account'); ?>
                                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                                    <td><?= $this->getHtml('Total'); ?>
                                <tbody>
                                <?php $count = 0;
                                foreach ([] as $key => $value) : ++$count; ?>
                                <?php endforeach; ?>
                                <?php if ($count === 0) : ?>
                                <tr>
                                    <td colspan="13" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                        <?php endif; ?>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="portlet">
                            <div class="portlet-head"><?= $this->getHtml('CostCenter'); ?><i class="g-icon download btn end-xs">download</i></div>
                            <div class="slider">
                            <table class="default sticky">
                                <thead>
                                <tr>
                                    <td><?= $this->getHtml('CostCenter'); ?>
                                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                                    <td><?= $this->getHtml('Total'); ?>
                                <tbody>
                                <?php $count = 0;
                                foreach ([] as $key => $value) : ++$count; ?>
                                <?php endforeach; ?>
                                <?php if ($count === 0) : ?>
                                <tr>
                                    <td colspan="13" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                        <?php endif; ?>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="portlet">
                            <div class="portlet-head"><?= $this->getHtml('CostObject'); ?><i class="g-icon download btn end-xs">download</i></div>
                            <div class="slider">
                            <table class="default sticky">
                                <thead>
                                <tr>
                                    <td><?= $this->getHtml('CostObject'); ?>
                                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                                    <td><?= $this->getHtml('Total'); ?>
                                <tbody>
                                <?php $count = 0;
                                foreach ([] as $key => $value) : ++$count; ?>
                                <?php endforeach; ?>
                                <?php if ($count === 0) : ?>
                                <tr>
                                    <td colspan="13" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                        <?php endif; ?>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="radio" id="c-tab2-3" name="tabular-2">
            <div class="tabview tab-3">
                <div class="row">
                    <div class="col-xs-6">
                        <section class="wf-100">
                            <div class="inner">
                            </div>
                        </section>
                    </div>
                    <div class="col-xs-6">
                        <section class="wf-100">
                            <div class="inner">
                            </div>
                        </section>
                    </div>
                    <div class="col-xs-6">
                        <section class="wf-100">
                            <div class="inner">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/account-list.tpl.php'; ?>