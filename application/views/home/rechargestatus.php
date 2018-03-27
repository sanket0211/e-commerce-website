<section id="page-title">

    <div class="container clearfix">
        <h1>Recharge Status</h1>
        <span>See the details of your mobile recharge</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">recharge status</li>
        </ol>
    </div>

</section>


<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Post Content
            ============================================= -->
            <div class="postcontent nobottommargin clearfix">

                <?php 
				if($txnstatus == 'SUCCESS'){

					echo '<div class="style-msg successmsg">';
                    echo        '<div class="sb-msg"><i class="icon-thumbs-up"></i><strong>Well done!</strong> You successfully recharged your mobile.</div>';
                    echo '   </div>';

					echo '<h3>Recharge Status</h3>';

					echo '<ul class="list-group">';
					    echo '<li class="list-group-item">joloapiorder ID:'.$joloapiorderid .'</li>';
					    echo '<li class="list-group-item">Recharge Status:'.$txnstatus.'</li>';
					    echo '<li class="list-group-item">Operator:'.$operator.'</li>';
					    echo '<li class="list-group-item">Number: '.$service.'</li>';
					    echo '<li class="list-group-item">MY order id:'.$mywebsiteorderid.'</li>';
					    echo '<li class="list-group-item">Operator Txn ID:'.$operatorid.'</li>';
					    echo '<li class="list-group-item">Error No.:'.$errorcode.'</li>';

					echo '</ul>';
				}
				else {
					echo '<div class="style-msg errormsg">';
                    echo        '<div class="sb-msg"><i class="icon-remove"></i><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
                    echo '   </div>';
				}
				?>

                
            </div><!-- .postcontent end -->
        </div>

    </div>

</section><!-- #content end -->