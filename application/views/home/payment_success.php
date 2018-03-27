<section id="page-title">

    <div class="container clearfix">
        <h1>Payment Details</h1>
        <span>View the details of the payment you have just made</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li><a href="active">Payment details</a></li>

        </ol>
    </div>

</section>


<?php


echo '<div class="style-msg infomsg">';
	echo '<div class="sb-msg"><i class="icon-info-sign"></i>'.$error.'</div>';
echo '</div>';
?>

<div class="style-msg2 successmsg">
    <div class="msgtitle">Payment Details</div>
    <div class="sb-msg">
        <ul>
            <li>Payment ID : <?php echo $payment_id; ?></li>
            <li>Buyer Name : <?php echo $buyer_name; ?></li>
            <li>Buyer Phone : <?php echo $buyer_phone; ?></li>
            <li>Buyer Email : <?php echo $buyer_email; ?></li>
            <li>Amount : <?php echo $amount; ?></li>
            <li>Created at : <?php echo $created_at; ?></li>
        </ul>
    </div>
</div>

