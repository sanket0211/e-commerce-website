<script>

    document.getElementById("howitworks").className = 'mega-menu';
    document.getElementById("aboutus").className = 'mega-menu';
    document.getElementById("contactus").className = 'current';
    document.getElementById("faqs").className = 'mega-menu';
    document.getElementById("community").className = 'mega-menu';
    document.getElementById("home").className = 'mega-menu';
    document.getElementById("products").className = 'mega-menu';
    

</script>


<div role="main" class="main">

<section id="page-title" class="page-title-mini">

    <div class="container clearfix">
        <h1>Contact Us</h1>
        <span>Everything you need to know about our Company</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Contact us</li>
        </ol>
    </div>

</section>

<section id="google-map" class="gmap slider-parallax"></section>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.gmap.js' ;?>"></script>

    <script type="text/javascript">

        $('#google-map').gMap({

            address: 'IIIT Gymnasium, Gachibowli, Hyderabad, Telangana 500032',
            maptype: 'ROADMAP',
            zoom: 14,
            markers: [
                {
                    address: "IIIT Gymnasium, Gachibowli, Hyderabad, Telangana 500032",
                    html: '<div style="width: 300px;"><h4 style="margin-bottom: 8px;">Hi, we\'re <span>Rentooz</span></h4><p class="nobottommargin">Our mission is to help people to <strong>earn</strong> and to <strong>learn</strong> online. We operate <strong>marketplaces</strong> where hundreds of thousands of people buy and sell digital goods every day, and a network of educational blogs where millions learn <strong>creative skills</strong>.</p></div>',
                    icon: {
                        image: "<?php echo base_url().'assets/images/icons/map-icon-red.png';?>",
                        iconsize: [32, 39],
                        iconanchor: [17.44,78.34]
                    }
                }
            ],
            doubleclickzoom: false,
            controls: {
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false
            }

        });

    </script><!-- Google Map End -->
<section id="content">
	<div id="googlemaps" class="google-map"></div>

		<div class="container topmargin bottommargin">

			<div class="row">
				<div class="col-md-6">

					<div class="alert alert-success hidden" id="contactSuccess">
						<strong>Success!</strong> Your message has been sent to us.
					</div>

					<div class="alert alert-danger hidden" id="contactError">
						<strong>Error!</strong> There was an error sending your message.
					</div>

					<h2 class="short"><strong>Contact</strong> Us</h2>

					<?php echo form_open('nonessentials/contactusform',array('class' => 'nobottommargin','name' => 'template-contactform')); ?>

						<div class="row">
							<div class="form-group">
								<div class="col-md-6">
									<label>Your name *</label>
									<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
								</div>
								<div class="col-md-6">
									<label>Your email address *</label>
									<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label>Subject</label>
									<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label>Message *</label>
									<textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message" required></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="button button-rounded button-reveal button-large button-dirtygreen tright" data-loading-text="Loading...">
									Send Message<i class="icon-email2"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6">

					<h4 class="push-top">Get in <strong>touch</strong></h4>

					<p>Feel free to contact us whenever you are in doubt. We, the rentooz team will always be there to help you out as much as possible. </p>


					<hr />

					<h4>The <strong>Office</strong></h4>
					<ul class="list-unstyled">
						<li><i class="fa fa-map-marker"></i> <strong>Address:</strong>Palash Nivas, OBH-E 201/OBH-E 214 IIIT-Hyderabad, Gachibowli,Hyderabad-500032, Telanagana</li>
						<li><i class="fa fa-phone"></i> <strong>Phone:</strong> (+91)9581105549 / (+91)9703531305</li>

						<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">support@rentooz.com</a></li>

					</ul>
					<hr/>
				</div>
			</div>

		</div>
	</div>
</section>