<?php
$settings = $this->db->select("*")
    ->get('setting')
    ->row();
?>


        <footer class="footer">
            <div class="footer-breadcrumbs">
                <div class="container">
                    <div class="breadcrumbs-row">
                        <ul class="f_breadcrumbs">
                            <li><a href="<?php echo base_url(); ?>"><span><?php echo display('home'); ?></span></a></li>
                            <li><a href="#"><span><?php echo isset($lang) && $lang =="french"?htmlspecialchars_decode(@$cat_info->cat_name_fr):htmlspecialchars_decode(@$cat_info->cat_name_en); ?></span></a></li>
                        </ul>
                        <div class="scroll-top" id="back-to-top">
                            <div class="scroll-top-text"><span><?php echo display('scroll_to_top'); ?></span></div>
                            <div class="scroll-top-icon"><i class="fa fa-angle-up"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.End of breadcrumbs -->
            <div class="action_btn_inner">
                <a href="<?php echo base_url('register'); ?>#tab1" class="action_btn">
                    <span class="action_title"><?php echo display('register'); ?></span>
                    <span class="lnr lnr-chevron-right action_icon"></span>
                    <span class="action_sub_title"><?php echo display('join_the_new_yera_of_cryptocurrency_exchange'); ?></span>
                </a>
                <a href="<?php echo base_url('register'); ?>#tab2" class="action_btn">
                    <span class="action_title"><?php echo display('sign_in'); ?></span>
                    <span class="lnr lnr-chevron-right action_icon"></span>
                    <span class="action_sub_title"><?php echo display('access_the_cryptocurrency_experience_you_deserve'); ?></span>
                </a>
            </div>
            <!-- /.End of action button -->
            <div class="main_footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="widget-contact">
                                <ul class="list-icon">
                                    <li><i class="fa fa-map-marker"></i> <?php echo htmlspecialchars_decode($settings->description) ?></li>
                                    <li><i class="fa fa-phone"></i> <?php echo html_escape($settings->phone) ?> </li>
                                    <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo html_escape($settings->email) ?>"><?php echo html_escape($settings->email) ?></a>
                                    </li>
                                    <li>
                                        <br><i class="fa fa-clock-o"></i><?php echo htmlspecialchars_decode(@$settings->office_time) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-4 col-md-offset-1">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="footer-box">
                                        <h3 class="footer-title"><?php echo display('our_company'); ?></h3>
                                        <ul class="footer-list">
                        <?php
                            foreach ($category as $cat_key => $cat_value) {
                                if ($cat_value->menu==2 || $cat_value->menu==3) { 
                                     $cat_name = isset($lang) && $lang =="french"?$cat_value->cat_name_fr:$cat_value->cat_name_en;
                                     $cat_slug = $cat_value->slug;
                        ?>
                                    <li><a href="<?php echo base_url(html_escape($cat_slug)); ?>"><?php echo html_escape($cat_name) ?></a></li>
                        <?php
                                }                               
                            }
                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="footer-box">
                                        <h3 class="footer-title"><?php echo display('services'); ?></h3>
                                        <ul class="footer-list">
                                            <?php 

                                                foreach ($service as $ser_key => $ser_value) {

                                                    $ser_headline    =   isset($lang) && $lang =="french"?$ser_value->headline_fr:$ser_value->headline_en;
                                            ?>

                                                    <li><a href="<?php echo base_url("service/".html_escape($ser_value->slug)); ?>"><?php echo htmlspecialchars_decode($ser_headline) ?></a></li>
                                            <?php

                                                }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="newsletter-box">
                                <h3 class="footer-title"><?php echo display('email_newslatter'); ?></h3>
                                <p><?php echo display('subscribe_to_our_newsletter'); ?></p>
                                <?php echo form_open('#','id="subscribeForm"  class="newsletter-form" name="subscribeForm" '); ?>
                                <form class='newsletter-form' action='#' method='post'>
                                    <input name="subscribe_email" placeholder="<?php echo display('email'); ?>" type="email">
                                    <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    <div class="envelope">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.End of main footer -->
            <div class="sub_footer">
                <div class="container">
                    <div class="logos-wrapper">
                        <div class="logos-row">
                            <div class="social-content">
                                <div class="social-row">
                                    <div class="social_icon">
                                        <?php foreach ($social_link as $key => $value) { ?>
                                        <a href="<?php echo html_escape($value->link); ?>" class=""><i class="fa fa-<?php echo html_escape($value->icon); ?>"></i></a>
                                        <?php } ?>
                                    </div>
                                    <div class="f-language">
                                    <?php echo form_open('#','id="langForm"  class="lang-form" name="langForm" '); ?>
                                        <select name="lang" class="selectpicker lang-change" id="lang-changeF" data-width="fit">
                                            <option value="english" data-content='<span class="flag-icon flag-icon-us"></span> English' <?php echo isset($lang) && $lang =="english"?'Selected':''; ?>>English</option>
                                            <option value="french"  data-content='<span class="flag-icon flag-icon-<?php echo html_escape($web_language->flag); ?>"></span> <?php echo html_escape($web_language->name); ?>' <?php echo isset($lang) && $lang =="french"?'Selected':''; ?>> <?php echo html_escape($web_language->name); ?></option>
                                        </select>
                                        <?php echo form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="copyright">
                            <span><?php echo htmlspecialchars_decode($settings->footer_text); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.End of sub footer -->
        </footer>
        <!-- /.End of footer -->

        

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/website/js/jquery.min.js?v=new'); ?>"></script>
        <!-- Home and CoinMarket Page Script -->
        <?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='home' || $this->uri->segment(1)=='coinmarket') { ?>
        <script src="<?php echo base_url('assets/website/streamer/angular.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/streamer/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/streamer/socket.io.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/streamer/ccc-streamer-utilities.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/streamer/streammyjs.js'); ?>"></script>
        <?php } ?>        
        <script src="<?php echo base_url('assets/js/sparkline.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/bootsnav.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/owl.carousel.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/wow.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/parallax-background.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/responsive.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/jquery.marquee.min.js'); ?>"></script>
        <?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='home') { ?>
        <script src="<?php echo base_url('assets/website/js/particles.min.js'); ?>"></script>
        <?php } ?>
        <script src="<?php echo base_url('assets/website/js/jquery.magnific-popup.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/bootstrap-select.min.js'); ?>"></script>
        <?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='home') { ?>
        <script src="<?php echo base_url('assets/website/js/app.js'); ?>"></script>
        <?php } ?>
        <script src="<?php echo base_url('assets/website/js/classie.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/custom.js?v=1'); ?>"></script>
        
        <!-- CoinMarket details Page Script -->
        <?php if ($this->uri->segment(1)=='coin-details') { ?>
          <script src="<?php echo base_url('assets/website/amcharts/amcharts.js');?>" type="text/javascript"></script>
          <script src="<?php echo base_url('assets/website/amcharts/serial.js'); ?>" type="text/javascript"></script>
          <script src="<?php echo base_url('assets/website/amcharts/amstock.js'); ?>" type="text/javascript"></script>
          <script src="<?php echo base_url('assets/website/amcharts/plugins/dataloader/dataloader.min.js') ?>"></script>
          <script src="<?php echo base_url('assets/website/amcharts/plugins/export/export.min.js') ?>"></script>
          <script src="<?php echo base_url('assets/website/amcharts/patterns.js') ?>"></script>
          <script src="<?php echo base_url('assets/website/amcharts/dark.js') ?>"></script>
          <script src="<?php echo base_url('assets/website/amcharts/script.js?v=new'); ?>" type="text/javascript"></script>
        <?php } ?>

        <?php if ($this->uri->segment(1)=='contact') { ?>
        <script src="<?php echo base_url('assets/website/js/contact.js?v=2'); ?>"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUmj7I0GuGJWRcol-pMUmM4rrnHS90DE8" type="text/javascript"></script>
        <?php } ?>
    </body>
</html>