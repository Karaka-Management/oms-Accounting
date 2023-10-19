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
        <section class="box wf-100">
            <div class="inner">
                <form>
                    <table class="layout wf-100">
                        <tr>
                            <td><label for="iAccountStart"><?= $this->getHtml('Account'); ?></label>
                            <td><label for="iAccountStart"><?= $this->getHtml('CostCenter'); ?>
                            <td><label for="iAccountStart"><?= $this->getHtml('CostObject'); ?>
                            <td><label for="iAccountStart"><?= $this->getHtml('EntryDate'); ?>
                        <tr>
                            <td><span class="input"><button type="button" id="account-start" formaction="" data-action='[{"type": "popup", "tpl": "entry-list-tpl", "aniIn": "fadeIn", "aniOut": "fadeOut", "stay": 1000}]'><i class="g-icon">book</i>
                                    </button><input type="number" id="iId" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="number" id="iId" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="number" id="iId" min="1" name="id" required></span>
                            <td><input type="datetime-local" id="iId" min="1" name="id" required>
                        <tr>
                            <td><label for="iAccountStart"><?= $this->getHtml('To'); ?></label>
                            <td><label for="iAccountStart"><?= $this->getHtml('To'); ?>
                            <td><label for="iAccountStart"><?= $this->getHtml('To'); ?>
                            <td><label for="iAccountStart"><?= $this->getHtml('To'); ?>
                        <tr>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="number" id="iId" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="number" id="iId" min="1" name="id" required></span>
                            <td><span class="input"><button type="button" formaction=""><i class="g-icon">book</i>
                                    </button><input type="number" id="iId" min="1" name="id" required></span>
                            <td><input type="datetime-local" id="iId" min="1" name="id" required>
                        <tr>
                            <td colspan="4"><input type="submit" value="<?= $this->getHtml('Search'); ?>" name="search">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>

<div class="box w-100">
    <div class="tabview tab-2">
        <ul class="tab-links">
            <li><label for="c-tab2-1"><?= $this->getHtml('List'); ?></label></li>
            <li><label for="c-tab2-2"><?= $this->getHtml('Evaluation'); ?></label></li>
            <li><label for="c-tab2-3"><?= $this->getHtml('Charts'); ?></label></li>
        </ul>
        <div class="tab-content">
            <input type="radio" id="c-tab2-1" name="tabular-2" checked>
            <div class="tab">
                <div class="row">
                    <div class="col-xs-12">
                        <section class="wf-100">
                            <table class="default">
                                <caption><?= $this->getHtml('Entries'); ?><i class="g-icon end-xs download btn">download</i></caption>
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
                        </section>
                    </div>
                </div>
            </div>
            <input type="radio" id="c-tab2-2" name="tabular-2">
            <div class="tab">
               <div class="row">
                    <div class="col-xs-4">
                        <section class="wf-100">
                            <table class="default">
                                <caption><?= $this->getHtml('Accounts'); ?><i class="g-icon end-xs download btn">download</i></caption>
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
                        </section>
                    </div>
                    <div class="col-xs-4">
                        <section class="wf-100">
                            <table class="table green">
                                <caption><?= $this->getHtml('CostCenter'); ?><i class="g-icon end-xs download btn">download</i></caption>
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
                        </section>
                    </div>
                    <div class="col-xs-4">
                        <section class="wf-100">
                            <table class="table blue">
                                <caption><?= $this->getHtml('CostObject'); ?><i class="g-icon end-xs download btn">download</i></caption>
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
                        </section>
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