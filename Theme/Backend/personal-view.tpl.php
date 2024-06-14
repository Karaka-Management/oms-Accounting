<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\HumanResourceTimeRecording
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Accounting\Models\AccountStatus;
use Modules\Admin\Models\ContactType;
use Modules\Billing\Models\BillMapper;
use Modules\Billing\Models\BillTransferType;
use Modules\Billing\Models\PurchaseBillMapper;
use Modules\Billing\Models\SalesBillMapper;
use Modules\ClientManagement\Models\Client;
use Modules\Media\Models\NullMedia;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Localization\ISO639Enum;
use phpOMS\Stdlib\Base\SmartDateTime;
use phpOMS\Uri\UriFactory;

/** @var \phpOMS\Views\View $this */
$account = $this->data['account'] ?? null;
$isNew   = ($account?->id ?? 0) === 0;

$isClient = $account instanceof Client;

$accountImage = $this->getData('accountImage') ?? new NullMedia();

$attributeView = $this->data['attributeView'];

$countryCodes = \phpOMS\Localization\ISO3166TwoEnum::getConstants();
$countries    = \phpOMS\Localization\ISO3166NameEnum::getConstants();
$languages    = ISO639Enum::getConstants();

$accountStatus = AccountStatus::getConstants();

echo $this->data['nav']->render(); ?>
<div class="tabview tab-2">
    <?php if (!$isNew) : ?>
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Account'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('Finance'); ?></label>
            <li><label for="c-tab-7"><?= $this->getHtml('Payment'); ?></label>
            <li><label for="c-tab-3"><?= $this->getHtml('Entries'); ?></label>
            <li><label for="c-tab-4"><?= $this->getHtml('Address'); ?></label>
            <li><label for="c-tab-5"><?= $this->getHtml('Files'); ?></label>
            <li><label for="c-tab-6"><?= $this->getHtml('Notes'); ?></label>
        </ul>
    </div>
    <?php endif; ?>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2"<?= $isNew || $this->request->uri->fragment === 'c-tab-1' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-lg-3 last-lg">
                    <section class="portlet">
                        <form id="accountForm" method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= UriFactory::build('{/api}accounting/profile?csrf={$CSRF}'); ?>">
                            <div class="portlet-body">
                            <div class="form-group">
                                    <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                                    <span class="input"><button type="button" formaction=""><i class="g-icon">book</i></button><input type="text" id="iId" min="1" name="id" value="<?= $this->printHtml($account->number); ?>"<?= $isNew ? ' required' : ' disabled'; ?>></span>
                                </div>

                                <div class="form-group">
                                    <label for="iStatus"><?= $this->getHtml('Status'); ?></label>
                                    <select id="iStatus" name="status">
                                        <?php foreach ($accountStatus as $status) : ?>
                                            <option value="<?= $status; ?>"<?= $account->status === $status ? ' selected': ''; ?>><?= $this->getHtml(':status-' . $status); ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iName1"><?= $this->getHtml('Name1'); ?></label>
                                    <input type="text" id="iName1" name="name1" value="<?= $this->printHtml($account->account->name1); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iName2"><?= $this->getHtml('Name2'); ?></label>
                                    <input type="text" id="iName2" name="name2" value="<?= $this->printHtml($account->account->name2); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="iName3"><?= $this->getHtml('Name3'); ?></label>
                                    <input type="text" id="iName3" name="name3" value="<?= $this->printHtml($account->account->name3); ?>">
                                </div>
                            </div>
                            <div class="portlet-foot">
                                <?php if ($isNew) : ?>
                                    <input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="create-account">
                                <?php else : ?>
                                    <input type="submit" value="<?= $this->getHtml('Save', '0', '0'); ?>" name="save-account-profile">
                                    <input class="cancel end-xs" type="submit" value="<?= $this->getHtml('Delete', '0', '0'); ?>" name="delete-account-profile">
                                <?php endif; ?>
                            </div>
                        </form>
                    </section>

                    <section class="portlet">
                        <div class="portlet-head">
                            <?= $this->getHtml('Contact'); ?>
                            <a class="end-xs" href=""><i class="g-icon btn">mail</i></a>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <label for="iPhone"><?= $this->getHtml('Phone'); ?></label>
                                <input type="text" id="iPhone" form="accountForm" name="phone" value="<?= $this->printHtml($account->account->getContactByType(ContactType::PHONE)->content); ?>">
                            </div>

                            <div class="form-group">
                                <label for="iEmail"><?= $this->getHtml('Email'); ?></label>
                                <input type="text" id="iEmail" form="accountForm" name="email" value="<?= $this->printHtml($account->account->getContactByType(ContactType::EMAIL)->content); ?>">
                            </div>

                            <div class="form-group">
                                <label for="iWebsite"><?= $this->getHtml('Website'); ?></label>
                                <input type="text" id="iWebsite" form="accountForm" name="website" value="<?= $this->printHtml($account->account->getContactByType(ContactType::WEBSITE)->content); ?>">
                            </div>
                        </div>
                    </section>

                    <section class="portlet map-small">
                        <div class="portlet-head">
                            <?= $this->getHtml('Address'); ?>
                            <span class="clickPopup end-xs">
                                <label for="addressDropdown"><i class="g-icon btn">print</i></label>
                                <input id="addressDropdown" name="addressDropdown" type="checkbox">
                                <div class="popup">
                                    <ul>
                                        <li>
                                            <input id="id1" type="checkbox">
                                            <ul>
                                                <li>
                                                    <label for="id1">
                                                        <a href="" class="button">Word</a>
                                                        <span></span>
                                                        <i class="g-icon expand">chevron_right</i>
                                                    </label>
                                                <li>Letter
                                            </ul>
                                        <li><label class="button cancel" for="addressDropdown">Cancel</label>
                                    </ul>
                                </div>
                            </span>
                        </div>
                        <div class="portlet-body">
                            <?php if (!empty($account->mainAddress->fao)) : ?>
                            <div class="form-group">
                                <label for="iFAO"><?= $this->getHtml('FAO'); ?></label>
                                <input type="text" id="iFAO" form="accountForm" name="fao" value="<?= $this->printHtml($account->mainAddress->fao); ?>">
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="iAddress"><?= $this->getHtml('Address'); ?></label>
                                <input type="text" id="iAddress" form="accountForm" name="address" value="<?= $this->printHtml($account->mainAddress->address); ?>" required>
                            </div>

                            <?php if (!empty($account->mainAddress->addressAddition)) : ?>
                            <div class="form-group">
                                <label for="iAddition"><?= $this->getHtml('Addition'); ?></label>
                                <input type="text" id="iAddition" form="accountForm" name="addition" value="<?= $this->printHtml($account->mainAddress->addressAddition); ?>">
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="iPostal"><?= $this->getHtml('Postal'); ?></label>
                                <input type="text" id="iPostal" form="accountForm" name="postal" value="<?= $this->printHtml($account->mainAddress->postal); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="iCity"><?= $this->getHtml('City'); ?></label>
                                <input type="text" id="iCity" form="accountForm" name="city" value="<?= $this->printHtml($account->mainAddress->city); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="iCountry"><?= $this->getHtml('Country'); ?></label>
                                <select id="iCountry" form="accountForm" name="country">
                                    <?php foreach ($countryCodes as $code3 => $code2) : ?>
                                    <option value="<?= $this->printHtml($code2); ?>"<?= $this->printHtml($code2 === $account->mainAddress->country ? ' selected' : ''); ?>><?= $this->printHtml($countries[$code3]); ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <?php if (!$isNew) : ?>
                            <div class="form-group">
                                <label for="iClientMap"><?= $this->getHtml('Map'); ?></label>
                                <div id="iClientMap" class="map" data-lat="<?= $account->mainAddress->lat; ?>" data-lon="<?= $account->mainAddress->lon; ?>"></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </section>

                    <?php if (!$isNew) : ?>
                    <section class="portlet">
                        <div class="portlet-body">
                            <img alt="<?= $this->printHtml($accountImage->name); ?>" width="100%" loading="lazy" class="item-image"
                                src="<?= $accountImage->id === 0
                                    ? 'Web/Backend/img/logo_grey.png'
                                    : UriFactory::build($accountImage->getPath()); ?>">
                        </div>
                    </section>

                    <section class="portlet hl-4">
                        <div class="portlet-body">
                            <textarea class="undecorated"><?= $this->printTextarea($account->info); ?></textarea>
                        </div>
                    </section>
                    <?php endif; ?>
                </div>

                <?php if (!$isNew) : ?>
                <div class="col-xs-12 col-lg-9 plain-grid">
                    <?php if (!empty($account->notes) && ($warning = $account->getEditorDocByTypeName('account_backend_warning'))->id !== 0) : ?>
                    <!-- If note warning exists -->
                    <div class="row">
                        <div class="col-xs-12">
                            <section class="portlet hl-1">
                                <div class="portlet-body"><?= $this->printHtml($warning->plain); ?></div>
                            </section>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->data['hasBilling']) : ?>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <section class="portlet hl-7">
                                <div class="portlet-body">
                                    <table class="wf-100">
                                        <tr><td><?= $this->getHtml('YTDSales'); ?>:
                                            <td><?= $isClient
                                                    ? SalesBillMapper::getClientNetSales($account->id, SmartDateTime::startOfYear($this->data['business_start']), new \DateTime('now'))->getAmount()
                                                    : PurchaseBillMapper::getSupplierNetSales($account->id, SmartDateTime::startOfYear($this->data['business_start']), new \DateTime('now'))->getAmount();
                                                ?>
                                        <tr><td><?= $this->getHtml('MTDSales'); ?>:
                                            <td><?= $isClient
                                                    ? SalesBillMapper::getClientNetSales($account->id, SmartDateTime::startOfMonth(), new \DateTime('now'))->getAmount()
                                                    : PurchaseBillMapper::getSupplierNetSales($account->id, SmartDateTime::startOfMonth(), new \DateTime('now'))->getAmount();
                                                ?>
                                        <tr><td><?= $this->getHtml('CLV'); ?>:
                                            <td><?= $isClient
                                                    ? SalesBillMapper::getCLVHistoric($account->id)->getAmount()
                                                    : PurchaseBillMapper::getSLVHistoric($account->id)->getAmount();
                                                ?>
                                    </table>
                                </div>
                            </section>
                        </div>

                        <div class="col-xs-12 col-lg-4">
                            <section class="portlet hl-2">
                                <div class="portlet-body">
                                    <table class="wf-100">
                                        <tr><td><?= $this->getHtml('LastContact'); ?>:
                                            <td><?= $isClient
                                                    ? SalesBillMapper::getClientLastOrder($account->id)?->format('Y-m-d')
                                                    : PurchaseBillMapper::getSupplierLastOrder($account->id)?->format('Y-m-d');
                                                ?>
                                        <tr><td><?= $this->getHtml('LastOrder'); ?>:
                                            <td><?= $isClient
                                                    ? SalesBillMapper::getClientLastOrder($account->id)?->format('Y-m-d')
                                                    : PurchaseBillMapper::getSupplierLastOrder($account->id)?->format('Y-m-d');
                                                ?>
                                        <tr><td><?= $this->getHtml('Created'); ?>:
                                            <td><?= $account->createdAt->format('Y-m-d H:i'); ?>
                                    </table>
                                </div>
                            </section>
                        </div>

                        <div class="col-xs-12 col-lg-4">
                            <section class="portlet hl-3">
                                <div class="portlet-body">
                                    <table class="wf-100">
                                        <tr><td><?= $this->getHtml('DSO'); ?>:
                                            <td>TBD
                                        <tr><td><?= $this->getHtml('Due'); ?>:
                                            <td>TBD
                                        <tr><td><?= $this->getHtml('Balance'); ?>:
                                            <td>TBD
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <section class="portlet">
                                <div class="portlet-head"><?= $this->getHtml('Notes'); ?></div>
                                <div class="slider">
                                <table id="iNotesItemList" class="default sticky">
                                    <thead>
                                    <tr>
                                        <td class="wf-100"><?= $this->getHtml('Title'); ?>
                                        <td><?= $this->getHtml('CreatedAt'); ?>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($account->notes as $note) :
                                        ++$count;
                                        $url = UriFactory::build('{/base}/editor/view?{?}&id=' . $note->id);
                                    ?>
                                    <tr data-href="<?= $url; ?>">
                                        <td><a href="<?= $url; ?>"><?= $note->title; ?></a>
                                        <td><a href="<?= $url; ?>"><?= $note->createdAt->format('Y-m-d'); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($count === 0) : ?>
                                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                    <?php endif; ?>
                                </table>
                                </div>
                            </section>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <section class="portlet">
                                <div class="portlet-head"><?= $this->getHtml('Documents'); ?></div>
                                <div class="slider">
                                <table id="iFilesClientList" class="default sticky">
                                    <thead>
                                    <tr>
                                        <td class="wf-100"><?= $this->getHtml('Title'); ?>
                                        <td>
                                        <td><?= $this->getHtml('CreatedAt'); ?>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($account->files as $file) :
                                        ++$count;
                                        $url = UriFactory::build('{/base}/media/view?{?}&id=' . $file->id);
                                    ?>
                                    <tr data-href="<?= $url; ?>">
                                        <td><a href="<?= $url; ?>"><?= $file->name; ?></a>
                                        <td><a href="<?= $url; ?>"><?= $file->extension; ?></a>
                                        <td><a href="<?= $url; ?>"><?= $file->createdAt->format('Y-m-d'); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($count === 0) : ?>
                                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                    <?php endif; ?>
                                </table>
                                </div>
                            </section>
                        </div>
                    </div>

                    <?php if ($this->data['hasBilling']) : ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <section class="portlet">
                                <div class="portlet-head"><?= $this->getHtml('RecentInvoices'); ?></div>
                                <table id="iSalesItemList" class="default sticky">
                                    <thead>
                                    <tr>
                                        <td><?= $this->getHtml('Number'); ?>
                                        <td><?= $this->getHtml('Type'); ?>
                                        <td class="wf-100"><?= $this->getHtml('Name'); ?>
                                        <td><?= $this->getHtml('Net'); ?>
                                        <td><?= $this->getHtml('Date'); ?>
                                    <tbody>
                                    <?php
                                    $newestInvoices = BillMapper::getAll()
                                        ->with('type')
                                        ->with('type/l11n')
                                        ->with($isClient ? 'client' : 'supplier')
                                        ->where($isClient ? 'client' : 'supplier', $account->id)
                                        ->where('type/l11n/language', $this->response->header->l11n->language)
                                        ->where('type/isAccounting', true)
                                        ->sort('id', OrderType::DESC)
                                        ->limit(5)
                                        ->executeGetArray();

                                    /** @var \Modules\Billing\Models\Bill $invoice */
                                    foreach ($newestInvoices as $invoice) :
                                        $url = UriFactory::build('{/base}/sales/bill/view?{?}&id=' . $invoice->id);
                                        ?>
                                    <tr data-href="<?= $url; ?>">
                                        <td><a href="<?= $url; ?>"><?= $invoice->getNumber(); ?></a>
                                        <td><a href="<?= $url; ?>"><?= $invoice->type->getL11n(); ?></a>
                                        <td><a href="<?= $url; ?>"><?= $invoice->billTo; ?></a>
                                        <td><a href="<?= $url; ?>"><?= $this->getCurrency($invoice->netSales, symbol: ''); ?></a>
                                        <td><a href="<?= $url; ?>"><?= $invoice->createdAt->format('Y-m-d'); ?></a>
                                    <?php endforeach; ?>
                                </table>
                            </section>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!$isNew) : ?>
        <input type="radio" id="c-tab-2" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-2' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('Account'); ?></div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <label for="iBalanceSheet"><?= $this->getHtml('BalanceSheet'); ?></label>
                                <input id="iBalanceSheet" type="text">
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('Accounts'); ?></div>
                        <div class="slider">
                        <table class="default sticky">
                            <thead>
                                <tr>
                                    <td>
                            <tbody>
                                <?php
                                $c = 0;
                                foreach ($this->data['fiAccounts'] as $fiAccount) :
                                    ++$c;
                                ?>
                                <tr>
                                    <td><?= $this->printHtml($fiAccount->code); ?>
                                <?php endforeach; ?>
                                <?php if ($c === 0) : ?>
                                <tr>
                                    <td colspan="1" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                <?php endif; ?>
                        </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-7" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-7' ? ' checked' : ''; ?>>
        <div class="tab">
        <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('Payment'); ?></div>
                        <div class="portlet-body">
                            <form>
                                <table class="layout wf-100">
                                    <tr><td><label for="iACType"><?= $this->getHtml('Type'); ?></label>
                                    <tr><td><select id="iACType" name="actype">
                                                <option><?= $this->getHtml('Wire'); ?>
                                                <option><?= $this->getHtml('Creditcard'); ?>
                                            </select>
                                    <tr><td colspan="2"><input type="submit" value="<?= $this->getHtml('Add', '0', '0'); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-3" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-3' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-lg-3 last-lg">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('QuickAction'); ?></div>
                        <div class="portlet-body">
                            TBD
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-lg-9 plain-grid">
                    <div class="row">
                        <div class="col-xs-12">
                            <section class="portlet col-simple" style="height: 350px;">
                                <div class="portlet-head top-xs"><?= $this->getHtml('Open'); ?></div>
                                <table id="iSalesItemList" class="default sticky">
                                    <thead>
                                    <tr>
                                        <td>
                                        <td><?= $this->getHtml('Info'); ?>
                                        <td><?= $this->getHtml('Date'); ?>
                                        <td><?= $this->getHtml('Credit'); ?>
                                        <td><?= $this->getHtml('Debit'); ?>
                                        <td><?= $this->getHtml('Number'); ?>
                                        <td class="wf-100"><?= $this->getHtml('Text'); ?>
                                        <td><?= $this->getHtml('Due'); ?>
                                        <td><?= $this->getHtml('Payment'); ?>
                                    <tbody>
                                    <tr>
                                        <td colspan="9" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                </table>
                                <div class="portlet-body col-xs"></div>
                                <div class="portlet-foot bottom-xs">
                                    <?= $this->getHtml('Total'); ?>: 0.00
                                    <?= $this->getHtml('Due'); ?>: 0.00
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                        <section class="portlet col-simple" style="height: 350px;">
                                <div class="portlet-head top-xs"><?= $this->getHtml('Total'); ?></div>
                                <table id="iSalesItemList" class="default sticky">
                                    <thead>
                                    <tr>
                                        <td><?= $this->getHtml('Info'); ?>
                                        <td><?= $this->getHtml('Date'); ?>
                                        <td><?= $this->getHtml('Credit'); ?>
                                        <td><?= $this->getHtml('Debit'); ?>
                                        <td><?= $this->getHtml('Number'); ?>
                                        <td class="wf-100"><?= $this->getHtml('Text'); ?>
                                        <td><?= $this->getHtml('Due'); ?>
                                        <td><?= $this->getHtml('Payment'); ?>
                                        <td><?= $this->getHtml('Balanced'); ?>
                                        <td><?= $this->getHtml('Balance'); ?>
                                    <tbody>
                                    <tr>
                                        <td colspan="10" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                </table>
                                <div class="portlet-body col-xs"></div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-4" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-4' ? ' checked' : ''; ?>>
        <div class="tab">
            <?= $this->data['contact-component']->render('account-contact', 'contacts', $account->account->contacts); ?>
            <?= $this->data['address-component']->render('account-address', 'addresses', $account->account->addresses); ?>
        </div>

        <input type="radio" id="c-tab-5" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-5' ? ' checked' : ''; ?>>
        <div class="tab col-simple">
            <?= $this->data['media-upload']->render('account-file', 'files', '', $account->files); ?>
        </div>

        <input type="radio" id="c-tab-6" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-6' ? ' checked' : ''; ?>>
        <div class="tab col-simple">
            <?= $this->data['note']->render('account-note', 'notes', $account->notes); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
