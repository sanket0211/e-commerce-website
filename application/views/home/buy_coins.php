
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Post Content
            ============================================= -->
            <div class="nobottommargin clearfix">

                <h3>Proceed to Buy</h3>

                <ul class="list-group">
                    <li class="list-group-item">Name : <?php echo $user_name; ?></li>
                    <li class="list-group-item">Email id : <?php echo $user_email; ?></li>
                    <li class="list-group-item">Coins to buy : <?php echo $get_coins; ?></li>
                    
                </ul>

                <?php
                $link = 'https://www.instamojo.com/rentooz/rentooz-payment/?data_readonly=data_name&data_readonly=data_email&data_readonly=data_phone&data_readonly=data_amount&data_sign='.$my_sign.'&data_email='.$user_email.'&data_amount='.$amount.'&data_name='.$user_name.'&data_phone='.$user_phone;
                echo '<a href="'.$link.'"><button>Proceed to pay</button></a>';
                ?>
            </div><!-- .postcontent end -->
        </div>
    </div>

</section><!-- #content end -->