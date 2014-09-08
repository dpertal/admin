<?php
/* @var $this QuoteController */
/* @var $model Quote */
$BASE_URL = Yii::app()->request->baseUrl;
$paid = 0;
$duenow = 0;
$billing_address = '';
$contact = '';
$bank = '';
$comments = '';
$no = $revision_no;

foreach ($model->jobInvoices as $value) {

    if ($_SESSION['invoice_id'] == $value->id) {
        $dateInv = $value->date_invoiced;
        $duenow = number_format($value->amount, 2);
        $billing_address = $value->billing_detail;
        $comments = $value->comments;
        $bank = $value->bank_detail;
        $contact = $value->billing_name;
        break;
    }
}
?>

<style>
    .clear {clear:both;}
    .quote_slip {width:695px; margin:0 auto; position: relative; border:0px solid #cecece; background:#fff; padding:15px 15px;}
    .invoice_title {position:absolute; left:-11px; top:43px; background-image:url(./images/invoice_title.jpg); 
                    width:207px; height:62px; padding-top:20px; text-align:center; font-size:38px; color:#fff; text-transform:uppercase}
    .grey2 {background:#f5f5f5;}
    .slip_detail td h4 {color:#d82128;}

    .company_info {float:right; margin-top:-220px; margin-right:35px; font-size:12px; color:#61686d; line-height:18px; text-align:right}
    .company_info h3 {font-size:25px; color:#d82128; padding-top:15px; font-weight:bold}
    .company_info a {color:#61686d;}
    .company_info span {color:#003e86; font-weight:bold}
    .client_info {float:left; width:500px; margin:100px 0 0 0; font-size:12px; color:#61686d; line-height:10px;}
    .client_info h3 {font-size:25px; color:#d82128; font-weight:bold;  margin-top:0px; padding:0px;}
    .client_info h4 {font-size:16px; color:#003e86; font-weight:bold; margin-top:10px; padding:0px;}
    .client_info a {color:#61686d;}


    .slip_nmber {width:600px; float:left; margin-bottom:20px; margin-top:40px;}
    .slip_nmber h2 {color:#003e86; font-size:38px}
    .slip_nmber span {color:#7d7d7d; font-weight:bold; font-size:16px;}
    .slip_nmber p {font-size:12px; color:#a1a7ac}

    .slip_detail th {padding:0 10px !important; font-size:18px; text-align:center; color:#63676b !important}
    .slip_detail td {padding:10px 20px !important}
    .slip_detail td h3 {color:#003e86; font-size:15px; padding-bottom:0px}
    .slip_detail td strong {color:#d82128; font-size:22px; display:block; text-align:center}

    .slip_detail tr.redbg {background:#db3c41; color:#fff}
    .slip_detail td h4 {font-size:15px;}

    .slip_totals {width:215px; float:right; margin:10px 0 0 0}
    .slip_totals th, .slip_totals td {width:150px !important; height:auto !important; padding:5px 10px !important; color:#63676b; font-size:14px !important;}
    .slip_totals th {text-align:right !important; border-bottom:1px solid #d6dde2 !important}
    .slip_totals td {border-bottom:1px solid #d6dde2 !important; border-left:1px solid #d6dde2 !important}
    .slip_totals strong {font-size:18px;}
    .slip_totals span {color:#d82128; font-size:30px;}

    .bank_details {float:right; text-align:right; margin-bottom:20px; font-size: 12px; color: #61686d; line-height: 10px; text-align: right; 
                   margin-left:520px; margin-top:-120px; padding-top:-10px; padding: 0px 15px;
                   background:#e5e7e9; border:1px solid #adaeb0; box-shadow:inset 1px 2px 2px #c6c7ca; border-radius:5px; width:200px}
    .bank_details h4 {font: 16px/20px 'Oswald', sans-serif; color: #003e86; font-weight: bold; padding-bottom: 5px;}
    .bank_details span {color:#003e86; font-weight:bold;}
    .bank_details strong {color:#d82128;}
    .bank_details textarea {background:none; width:100%; font-size: 12px; color: #61686d; line-height: 18px; height:100px; font-family:Arial, Helvetica, sans-serif; text-align:right}

    p{line-height: 15px;padding:0px; margin:0px;}
    .quote_slip table {border:1px solid #d6dde2; border-radius:3px; width:650px; font-size:12px; color:#4e4e4e;}
    .quote_slip table th {background:#f4f6f8; padding:0px; margin:0px;border-bottom:1px solid #d6dde2; border-left:1px solid #d6dde2; height:10px; font-size:16px; color:#4e4e4e}
    .quote_slip table th:first-child {border-left:0px;}
    .quote_slip table th, .contents table td {text-align:left; padding:5px 0;}
    .quote_slip table td {border-left:1px solid #d6dde2; border-bottom:1px solid #d6dde2;}
    .quote_slip table td:first-child {border-left:0px;}
    .quote_slip table tr:last-child td {border-bottom:0px;}
    .quote_slip table .name, .contents table .date {text-align:center;}
    .quote_slip table .time {padding-left:15px;}



    .invoice_title2 {left:-11px; top:53px;float:left; padding-top:30px;font-size:30px;background-image::url(http://www.constructionsystem.com.au/images/invoice_title2.png); width:360px; height:52px; padding-top:10px; text-align:center; color:#fff; text-transform:uppercase}

    .slip_nmber2 {width:300px; float:left; margin-top:10px;}
    .slip_nmber2 h2 {color:#003e86; font-size:30px}
    .slip_nmber2 span {color:#7d7d7d; font-weight:bold; font-size:16px;}
    .slip_nmber2 p {font-size:12px; color:#a1a7ac}


    .statement_detail th {text-transform:uppercase;}
    .statement_detail th, .statement_detail td {text-align:center !important; padding:5px 10px !important;}

    .statement_detail .pyment_descp {text-align:left !important; width:250px;}

    .statement_detail td strong {color:#d82128; font-size:18px;}

    .slip_totals2 {width:400px; float:right; margin:30px 0 0 0}
    .slip_totals2 th, .slip_totals2 td {width:150px !important; height:auto !important; padding:5px 10px !important; color:#63676b;font-size:14px !important;}
    .slip_totals2 th {text-align:right !important; border-bottom:1px solid #d6dde2 !important}
    .slip_totals2 td {border-bottom:1px solid #d6dde2 !important; border-left:1px solid #d6dde2 !important}
    .slip_totals2 strong {font-size:18px;}
    .slip_totals2 span {color:#d82128; font-size:30px;}

    .invoice_buttons2 {float:left; margin-top:100px;}
    .invoice_buttons2 a {height:48px; line-height:48px; float:left; width:auto; padding:0 30px; margin-right:10px}
</style>
<div class="quote_slip">
    <div class="slip_btm"></div>
    <div class="invoice_title">Invoice</div>
    <div class="client_info">
        <h4>Bill To:</h4>

        <?php
        $owner_name = '';
        $agency_name = '';
        $agency_address = '';
        if ($model->agent->role_id == '6') { //agent quote
            $owner_name = "<p>Owner Name: " . $model->property_owner_name_1 . "</p>";
            $agency = User::model()->findByPk($model->agent->parent);
            $agency_name = "<h3>C/O " . $agency->first_name . "</h3>";
            $agency_address = "<p>Agency Address: " . $agency->address . "</p>";
        } else { //private 
            $owner_name = "<p>Owner Name: " . $model->agent->first_name . " " . $model->agent->last_name . "</p>";
        }
        ?>
        <?= $owner_name ?>
        <?= $agency_name ?><br /> <br /> 
        <?= $agency_address ?>
        <p><strong>Property Address:</strong> <?= $model->property_address ?>, <?= $model->property_postcode ?>, <?= $model->property_suburb ?></p>

    </div>
    <div class="company_info">
        <img src="./images/logo2.png" alt="">
        <h3><span>SPT</span> Constructions PTY LTD</h3>
        <p>PO Box 3007</p>
        <p>Cotham LPO</p>
        <p>Kew, VIC</p>
        <p>3101</p>
        <p>Ph: 03 9818 2681</p>
        <p>Email: <a href="mailto:info@sptconstructions.com.au">info@sptconstructions.com.au</a></p>
        <p><span>ABN:</span> 173 8811 8896</p>
    </div>
    <div class="clear"></div>
    <div class="slip_nmber">
        <h2>Invoice No: <?= $model->id ?> <?php
            if ($no != 0) {
                echo " - " . $no;
            }
            ?></h2>
        <span><?= date("Y-m-d H:i:s") ?></span>
    </div>
    <div class="bank_details">
        <h4>Bank Detail</h4>
        <p><?= nl2br($bank) ?></p>
    </div>

    <table class="slip_detail" width="650" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><th style="border-top:1px solid #d6dde2;padding-left:10px;">Description </th><th style="width:200px; text-align:center;border-right:1px solid #d6dde2;border-top:1px solid #d6dde2;">Amount</th></tr>
            <?php
            $total = 0;
            $section = 1;
            foreach ($model->quoteJobs as $id => $child):
                if ($child->type == 1) {
                    $total+=$child->amount;

                    $style = '';
                    if ($section % 2 == 0)
                        $style = 'class="grey2"';
                    ?>
                    <tr <?= $style ?>>
                        <td style="width:465px;">
                            <h3 style="padding:0; margin:0px 0 10px 0;"><?= $section ?>. <?= $child->job_title ?>:</h3>
                            <?php
                            $points = 1;
                            for ($i = 1; $i <= 17; $i++) {
                                $dd = "desc" . $i;
                                if ($child->$dd != '') {
                                    echo "<p>$section.$points  " . nl2br($child->$dd) . "</p>";
                                    $points++;
                                }
                            }
                            ?>
                            <br />
                        </td>
                        <td style="border-right:1px solid #d6dde2;" align="right"><strong>$<?= number_format($child->amount, 2) ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-right:1px solid #d6dde2;width:500px;">
                            <h4 style="padding:0px;margin:0px;">Note:</h4>
                            <p ><?= $child->note ?></p>
                            <br />
                        </td>
                    </tr>
                    <?php
                    $section++;
                }endforeach;
            ?>

        </tbody></table>


    <?php
    $subtotal = number_format($total, 2);
    $gst = number_format($total * 0.1, 2);
    $discount = number_format($model->discount, 2);
    $balance = number_format($total + $total * 0.1 - $paid, 2);
    $total = number_format($total + $total * 0.1 - $model->discount, 2);

    $paid = number_format($paid, 2);
    ?>

    <div class="slip_totals" style="border:1px red #d6dde2;margin-left:455px;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tbody><tr>
                    <th style="width:100px;">&nbsp;Subtotal</th>
                    <td style="width:150px;" align="right">$<?= $subtotal ?> </td>
                </tr>
                <tr>
                    <th>&nbsp;GST</th>
                    <td align="right">$<?= $gst ?></td>
                </tr>
                <tr>
                    <th>&nbsp;Discount</th>
                    <td align="right">$ <?= $discount ?></td>
                </tr>
                <tr>
                    <th>&nbsp;Total</th>
                    <td align="right">$<?= $total ?></td>
                </tr>
                <tr>
                    <th>&nbsp;Paid</th>
                    <td align="right">$<?= $paid ?></td>
                </tr>
                <tr>
                    <th>&nbsp;Balance</th>
                    <td align="right">$<?= $balance ?></td>
                </tr>
                <tr>
                    <th><strong>&nbsp;Due Now</strong></th>
                    <td align="right"><span>$<?= $duenow ?></span></td>
                </tr>
            </tbody></table>
    </div>
    <div class="clear"></div>
</div>
<?php /*?><div class="quote_slip" style="height: 70%;">
    <div class="slip_btm"></div>
    <div class="invoice_title2" style="margin-top:100px !important;padding-top:30px;">Payment Statement</div>
    <div class="slip_nmber2">
        <h2>Statement No: <?= $model->id ?></h2>
        <span><?= $model->modify_datetime ?></span>
    </div>
    <div class="company_info" style="margin-top:-160px;margin-right:20px;">
        <img src="./images/logo2.png" alt="">
        <h3><span>SPT</span> Constructions PTY LTD</h3>
    </div>
    <div class="clear"></div>
    <div class="statement_detail" style="margin-top: 50px;">
        <table border="0"  width="650" cellpadding="0" cellspacing="0">
            <tbody><tr>
                    <th class="pyment_descp" style="border-top:1px solid #d6dde2;">
                        Description
                    </th>
                    <th style="border-top:1px solid #d6dde2;">
                        Paid to Date
                    </th>
                    <th style="border-top:1px solid #d6dde2;">
                        To be invoiced
                    </th>
                    <th style="border-right:1px solid #d6dde2;border-top:1px solid #d6dde2;">
                        Due this invoice
                    </th>
                </tr>
                <tr>
                    <td class="pyment_descp">
<?= $comments ?>
                    </td>
                    <td>
                        <strong>$<?= $paid ?></strong>
                    </td>
                    <td>
                    </td>
                    <td style="border-right:1px solid #d6dde2">
                    </td>
                </tr>
                <tr class="grey2">
                    <td class="pyment_descp">
                        &nbsp;
                    </td>
                    <td>

                    </td>
                    <td>
                    </td>
                    <td style="border-right:1px solid #d6dde2">
                    </td>
                </tr>
                <tr>
                    <td class="pyment_descp">
                        &nbsp;
                    </td>
                    <td>

                    </td>
                    <td>
                    </td>
                    <td style="border-right:1px solid #d6dde2">
                    </td>
                </tr>
                <tr class="grey2">
                    <td class="pyment_descp">
                        &nbsp;
                    </td>
                    <td>

                    </td>
                    <td>
                    </td>
                    <td style="border-right:1px solid #d6dde2">
                    </td>
                </tr>
                <tr>
                    <td class="pyment_descp">
                        &nbsp;
                    </td>
                    <td>

                    </td>
                    <td>
                    </td>
                    <td style="border-right:1px solid #d6dde2">
                    </td>
                </tr>
            </tbody></table>
    </div>
    <div class="clear"></div>
    <div class="slip_totals2">
        <table border="0" cellspacing="0" cellpadding="0" style="border:1px red #d6dde2;margin-left:463px;">
            <tbody><tr>
                    <th style="border-top:1px solid #d6dde2;">Balance for inovice: <?= $model->id ?></th>
                    <td  style="border-right:1px solid #d6dde2;border-top:1px solid #d6dde2;">$<?= $balance ?> </td>
                </tr>
                <tr>
                    <th><strong>Due Now</strong></th>
                    <td style="border-right:1px solid #d6dde2"><span>$<?= $duenow ?></span></td>
                </tr>
                <tr>
                    <th style="text-align:left !important;border-right:1px solid #d6dde2" colspan="2">This amount includes the GST of $<?= $gst ?></th>
                </tr>
            </tbody></table>
    </div>
    <div class="clear"></div>
</div>
<?php */ ?>