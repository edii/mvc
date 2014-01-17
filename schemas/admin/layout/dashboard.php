<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rotor (v2.0) admin</title>
    <meta name="author" content="SuggeElson" />
    <meta name="description" content="Supr admin template - new premium responsive admin template. This template is designed to help you build the site administration without losing valuable time.Template contains all the important functions which must have one backend system.Build on great twitter boostrap framework" />
    <meta name="keywords" content="admin, admin template, admin theme, responsive, responsive admin, responsive admin template, responsive theme, themeforest, 960 grid system, grid, grid theme, liquid, masonry, jquery, administration, administration template, administration theme, mobile, touch , responsive layout, boostrap, twitter boostrap" />
    <meta name="application-name" content="Supr admin template" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Force IE9 to render in normla mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Le styles -->
    <!-- Use new way for google web fonts 
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
    <!-- Headings -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />
    <!-- Text -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> 
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <!-- Core stylesheets do not remove -->
    <link id="bootstrap" href="/style/admin/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link id="bootstrap-responsive" href="/style/admin/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
    <link href="/style/admin/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="/style/admin/css/icons.css" rel="stylesheet" type="text/css" />

    <!-- Plugins stylesheets -->
    <link href="/style/admin/plugins/misc/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />
    <link href="/style/admin/plugins/misc/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="/style/admin/plugins/misc/search/tipuesearch.css" type="text/css" rel="stylesheet" />

    <link href="/style/admin/plugins/forms/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="/style/admin/css/main.css" rel="stylesheet" type="text/css" /> 

    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="/style/admin/css/custom.css" rel="stylesheet" type="text/css" /> 

    <!--[if IE 8]><link href="/style/admin/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="/style/admin/js/libs/excanvas.min.js"></script>
      <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script type="text/javascript" src="/style/admin/js/libs/respond.min.js"></script>
    <![endif]-->
    
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/style/admin/image/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/style/admin/image/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/style/admin/image/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/style/admin/image/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="/style/admin/image/apple-touch-icon-57-precomposed.png" />
    
    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name="application-name" content="Supr"/> 
    <meta name="msapplication-TileColor" content="#3399cc"/> 

    <!-- Load modernizr first -->
    <script type="text/javascript" src="/style/admin/js/libs/modernizr.js"></script>

    </head>
      
    <body>
    
       
    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>    
    
    <?= $this->getBox('home/header'); ?>
        
    <div id="wrapper">
        <!--Responsive navigation button-->  
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>

        <!--Left Sidebar collapse button-->  
        <div class="collapseBtn leftbar">
             <a href="#" class="tipR" title="Hide Left Sidebar"><span class="icon12 minia-icon-layout"></span></a>
        </div>

        <!--Sidebar background-->
        <div id="sidebarbg"></div>
        <!--Sidebar content-->
        <div id="sidebar">

            <div class="shortcuts">
                <ul>
                    <li><a href="support.html" title="Support section" class="tip"><span class="icon24 icomoon-icon-support"></span></a></li>
                    <li><a href="#" title="Database backup" class="tip"><span class="icon24 icomoon-icon-database"></span></a></li>
                    <li><a href="charts.html" title="Sales statistics" class="tip"><span class="icon24 icomoon-icon-pie-2"></span></a></li>
                    <li><a href="#" title="Write post" class="tip"><span class="icon24 icomoon-icon-pencil"></span></a></li>
                </ul>
            </div><!-- End search -->            

            <?php
                $this->getBox('tree/index'); // navigation
            ?>

            <div class="sidebar-widget">
                <h5 class="title">Monthly Bandwidth Transfer</h5>
                <div class="content">
                    <span class="icon16 icomoon-icon-loop left"></span>
                    <div class="progress progress-mini progress-danger left tip" title="87%">
                      <div class="bar" style="width: 87%;"></div>
                    </div>
                    <span class="percent">87%</span>
                    <div class="stat">19419.94 / 12000 MB</div>
                </div>

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">
                <h5 class="title">Disk Space Usage</h5>
                <div class="content">
                    <span class="icon16  icomoon-icon-storage-2 left"></span>
                    <div class="progress progress-mini progress-success left tip" title="16%">
                      <div class="bar" style="width: 16%;"></div>
                    </div>
                    <span class="percent">16%</span>
                    <div class="stat">304.44 / 8000 MB</div>
                </div>

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">
                <h5 class="title">Ad sense stats</h5>
                <div class="content">

                    <div class="stats">
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Advert View</div>
                            </div>
                            <span class="icon16 icomoon-icon-eye left"></span>
                            <div class="number">21,501</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-up-2 green"></span>
                                5%
                            </div>
                            <span id="stat1" class="spark"></span>
                        </div>
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Clicks</div>
                            </div>
                            <span class="icon16 icomoon-icon-thumbs-up left"></span>
                            <div class="number">308</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-down-2 red"></span>
                                8%
                            </div>
                            <span id="stat2" class="spark"></span>
                        </div>
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Page CTR</div>
                            </div>
                            <span class="icon16 icomoon-icon-heart left"></span>
                            <div class="number">4%</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-down-2 red"></span>
                                1%
                            </div>
                            <span id="stat3" class="spark"></span>
                        </div>
                        <div class="item">
                            <div class="head clearfix">
                                <div class="txt">Earn money</div>
                            </div>
                            <span class="icon16 icomoon-icon-coin left"></span>
                            <div class="number">$376</div>
                            <div class="change">
                                <span class="icon24 icomoon-icon-arrow-up-2 green"></span>
                                26%
                            </div>
                            <span id="stat4" class="spark"></span>
                        </div>
                    </div>

                </div>

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">
                <h5 class="title">Right now</h5>
                <div class="content">
                    <div class="rightnow">
                        <ul class="unstyled">
                            <li><span class="number">34</span><span class="icon16 icomoon-icon-new"></span>Posts</li>
                            <li><span class="number">7</span><span class="icon16 icomoon-icon-file"></span>Pages</li>
                            <li><span class="number">14</span><span class="icon16 icomoon-icon-list-2"></span>Categories</li>
                            <li><span class="number">201</span><span class="icon16 icomoon-icon-tag"></span>Tags</li>
                        </ul>
                    </div>
                </div>

            </div><!-- End .sidenav-widget -->

        </div><!-- End #sidebar -->
        
        <?= $content ?>
    </div><!-- End #wrapper -->
    
    <!-- Le javascript
    ================================================== -->
    <!-- Important plugins put in all pages -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/style/admin/js/bootstrap/bootstrap.js"></script>  
    <script type="text/javascript" src="/style/admin/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="/style/admin/js/libs/jRespond.min.js"></script>

    <!-- Charts plugins -->
    <script type="text/javascript" src="/style/admin/plugins/charts/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/charts/flot/jquery.flot.grow.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/charts/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/charts/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/charts/flot/jquery.flot.tooltip_0.4.4.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/charts/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/charts/sparkline/jquery.sparkline.min.js"></script><!-- Sparkline plugin -->
    <script type="text/javascript" src="/style/admin/plugins/charts/knob/jquery.knob.js"></script><!-- Circular sliders and stats -->

    <!-- Misc plugins -->
    <script type="text/javascript" src="/style/admin/plugins/misc/fullcalendar/fullcalendar.min.js"></script><!-- Calendar plugin -->
    <script type="text/javascript" src="/style/admin/plugins/misc/qtip/jquery.qtip.min.js"></script><!-- Custom tooltip plugin -->
    <script type="text/javascript" src="/style/admin/plugins/misc/totop/jquery.ui.totop.min.js"></script> <!-- Back to top plugin -->
    
    <!-- Search plugin -->
    <script type="text/javascript" src="/style/admin/plugins/misc/search/tipuesearch_set.js"></script>
    <script type="text/javascript" src="/style/admin/plugins/misc/search/tipuesearch_data.js"></script><!-- JSON for searched results -->
    <script type="text/javascript" src="/style/admin/plugins/misc/search/tipuesearch.js"></script>

    <!-- Form plugins -->
    <script type="text/javascript" src="/style/admin/plugins/forms/uniform/jquery.uniform.min.js"></script>
    
    <!-- Init plugins -->
    <script type="text/javascript" src="/style/admin/js/main.js"></script><!-- Core js functions -->
    <script type="text/javascript" src="/style/admin/js/dashboard.js"></script><!-- Init plugins only for page -->

    </body>
</html>
