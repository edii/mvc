<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>

<?php if(!$validate): ?>
    <!-- error fatall or other -->
<?php else: ?>

<div id="header">

    <div class="navbar">
        <div class="navbar-inner">
          <div class="container-fluid">
            <a class="brand" href="dashboard.html">Rotor (v2.0).<span class="slogan">admin</span></a>
            <div class="nav-no-collapse">
                <ul class="nav">
                    <li class="active"><a href="dashboard.html"><span class="icon16 icomoon-icon-screen-2"></span> <span class="txt">Dashboard</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="icon16 icomoon-icon-cog"></span><span class="txt"> Settings</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="menu">
                                <ul>
                                    <li>                                                    
                                        <a href="#"><span class="icon16 icomoon-icon-equalizer"></span>Site config</a>
                                    </li>
                                    <li>                                                    
                                        <a href="#"><span class="icon16 icomoon-icon-wrench"></span>Plugins</a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon16 icomoon-icon-image-2"></span>Themes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="icon16 icomoon-icon-envelop"></span><span class="txt">Messages</span><span class="notification">8</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="menu">
                                <ul class="messages">    
                                    <li class="header"><strong>Messages</strong> (10) emails and (2) PM</li>
                                    <li>
                                       <span class="icon"><span class="icon16 icomoon-icon-user-plus"></span></span>
                                        <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Sammy Morerira</strong></a><span class="time">35 min ago</span></span>
                                        <span class="msg">I have question about new function ...</span>
                                    </li>
                                    <li>
                                       <span class="icon avatar"><img src="/style/admin/image/avatar.jpg" alt="" /></span>
                                        <span class="name"><a data-toggle="modal" href="#myModal1"><strong>George Michael</strong></a><span class="time">1 hour ago</span></span>
                                        <span class="msg">I need to meet you urgent please call me ...</span>
                                    </li>
                                    <li>
                                        <span class="icon"><span class="icon16 icomoon-icon-envelop"></span></span>
                                        <span class="name"><a data-toggle="modal" href="#myModal1"><strong>Ivanovich</strong></a><span class="time">1 day ago</span></span>
                                        <span class="msg">I send you my suggestion, please look and ...</span>
                                    </li>
                                    <li class="view-all"><a href="#">View all messages <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav pull-right usernav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="icon16 icomoon-icon-bell"></span><span class="notification">3</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="menu">
                                <ul class="notif">
                                    <li class="header"><strong>Notifications</strong> (3) items</li>
                                    <li>
                                        <a href="#">
                                            <span class="icon"><span class="icon16 icomoon-icon-user-plus"></span></span>
                                            <span class="event">1 User is registred</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="icon"><span class="icon16 icomoon-icon-bubble-3"></span></span>
                                            <span class="event">Jony add 1 comment</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="icon"><span class="icon16 icomoon-icon-new"></span></span>
                                            <span class="event">admin Julia added post with a long description</span>
                                        </a>
                                    </li>
                                    <li class="view-all"><a href="#">View all notifications <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                            <img src="/style/admin/image/avatar.jpg" alt="" class="image" /> 
                            <span class="txt"><?= $_session['email'] ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="menu">
                                <ul>
                                    <li>
                                        <a href="#"><span class="icon16 icomoon-icon-user-plus"></span>Edit profile</a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon16 icomoon-icon-bubble-2"></span>Approve comments</a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon16 icomoon-icon-plus"></span>Add user</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/<?= _request_uri ?>/home/logout/?logout=true"><span class="icon16 icomoon-icon-exit"></span><span class="txt"> Logout</span></a></li>
                </ul>
            </div><!-- /.nav-collapse -->
          </div>
        </div><!-- /navbar-inner -->
      </div><!-- /navbar --> 

</div><!-- End #header -->

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

    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->

            <div class="heading">

                <h3>Dashboard</h3>                    

                <div class="resBtnSearch">
                    <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
                </div>

                <div class="search">

                    <form id="searchform" action="search.html">
                        <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                        <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                    </form>

                </div><!-- End search -->

                <ul class="breadcrumb">
                    <li>You are here:</li>
                    <li>
                        <a href="#" class="tip" title="back to dashboard">
                            <span class="icon16 icomoon-icon-screen-2"></span>
                        </a> 
                        <span class="divider">
                            <span class="icon16 icomoon-icon-arrow-right-3"></span>
                        </span>
                    </li>
                    <li class="active">Dashboard</li>
                </ul>

            </div><!-- End .heading-->

            <!-- Build page from here: -->
            <div class="row-fluid">

                <div class="span8">
                    <div class="centerContent">

                        <ul class="bigBtnIcon">
                            <li>
                                <a href="#" title="I`m with gradient" class="tipB">
                                    <span class="icon icomoon-icon-users"></span>
                                    <span class="txt">Users</span>
                                    <span class="notification">5</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon icomoon-icon-support"></span>
                                    <span class="txt">Support tickets</span>
                                    <span class="notification blue">12</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="I`m with pattern" class="pattern tipB">
                                    <span class="icon icomoon-icon-bubbles-2"></span>
                                    <span class="txt">New Comments</span>
                                    <span class="notification green">23</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon icomoon-icon-basket"></span>
                                    <span class="txt">Orders</span>
                                    <span class="notification">+5</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon icomoon-icon-history"></span>
                                    <span class="txt">Backups</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon icomoon-icon-meter-fast"></span>
                                    <span class="txt">Site Usage</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- End .span8 -->

                <div class="span4">
                    <div class="centerContent">
                        <div dir="ltr" class="circle-stats">

                            <div class="circular-item tipB" title="Site overload">
                                <span class="icon icomoon-icon-fire"></span>
                                <input type="text" value="62" class="redCircle" />
                            </div>

                            <div class="circular-item tipB" title="Site average load time">
                                <span class="icon icomoon-icon-busy"></span>
                                <input type="text" value="12" class="blueCircle" />
                            </div>

                            <div class="circular-item tipB" title="Target complete">
                                <span class="icon icomoon-icon-target-2"></span>
                                <input type="text" value="94" class="greenCircle" />
                            </div>

                        </div>
                    </div>

                </div><!-- End .span4 -->

            </div><!-- End .row-fluid -->

            <div class="row-fluid">

                <div class="span8">

                    <div class="box chart gradient">

                        <div class="title">

                            <h4>
                                <span class="icon16 icomoon-icon-bars"></span>
                                <span>Visitors Chart</span>
                            </h4>
                            <a href="#" class="minimize">Minimize</a>
                        </div>
                        <div class="content" style="padding-bottom:0;">
                           <div class="visitors-chart" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
                           <ul class="chartShortcuts">
                                <li>
                                    <a href="#">
                                        <span class="head">Total Visits</span>
                                        <span class="number">509</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="head">Uniqiue Visits</span>
                                        <span class="number">309</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="head">External Visits</span>
                                        <span class="number">109</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="head">Impressions</span>
                                        <span class="number">325</span>
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div><!-- End .box -->

                </div><!-- End .span8 -->

                <div class="span4">

                    <div class="sparkStats">
                        <h4>389 people visited this site <a href="#" class="icon tip" title="Configure"><span class="icon16 icomoon-icon-cog-2"></span></a></h4>
                        <ul class="unstyled">
                            <li><span class="sparkLine1 "></span> Visits: <span class="number">509</span></li>
                            <li>
                                <span class="sparkLine2"></span>
                                Unique Visitors: 
                                <span class="number">389</span>
                            </li>
                            <li><span class="sparkLine3"></span> 
                                Pageviews: 
                                <span class="number">731</span>
                            </li>
                            <li><span class="sparkLine4"></span>
                                Pages / Visit: 
                                <span class="number">1.44</span>
                            </li>
                            <li><span class="sparkLine5"></span>
                                Avg. Visit Duration: 
                                <span class="number">00:01:21</span>
                            </li>
                            <li><span class="sparkLine6"></span>
                                Bounce Rate: <span class="number">68.37%</span>
                            </li>
                            <li><span class="sparkLine7"></span>
                                % New Visits: 
                                <span class="number">76.23%</span>
                            </li>

                        </ul>
                        <div class="right" style="padding: 15px 0">
                            <a href="charts.html" class="btn btn-info">View full statistic <span class="icon16 icomoon-icon-arrow-right-3 white"></span></a>
                        </div>
                    </div><!-- End .sparkStats -->


                </div><!-- End .span4 -->

            </div><!-- End .row-fluid -->

            <div class="row-fluid">

                <div class="span4">

                    <div class="box gradient">

                        <div class="title">

                            <h4>
                                <span class="icon16 icomoon-icon-pie"></span>
                                <span>Visitors overview</span>
                            </h4>
                            <a href="#" class="minimize">Minimize</a>
                        </div>
                        <div class="content">
                           <div class="pieStats" style="height: 240px; width:100%;">

                            </div>
                        </div>

                    </div><!-- End .box -->


                </div><!-- End .span4 -->

                <div class="span4">
                    <div class="box gradient">

                        <div class="title">

                            <h4>
                                <span class="icon16 icomoon-icon-thumbs-up"></span>
                                <span>Vital Stats  <span class="label label-success"><span class="icomoon-icon-arrow-up-2 white"></span>1268</span></span>
                            </h4>
                            <a href="#" class="minimize">Minimize</a>
                        </div>
                        <div class="content">

                            <div class="vital-stats" style="padding-bottom:23px">
                                <ul class="unstyled">
                                    <li>
                                        <span class="icon24 icomoon-icon-arrow-up-2 green"></span> 81% Clicks
                                        <span class="pull-right strong">567</span>
                                        <div class="progress progress-striped ">
                                            <div class="bar" style="width: 81%;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon24 icomoon-icon-arrow-up-2 green"></span> 72% Uniquie Clicks
                                        <span class="pull-right strong">507</span>
                                        <div class="progress progress-success progress-striped ">
                                            <div class="bar" style="width: 72%;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon24 icomoon-icon-arrow-down-2 red"></span> 53% Impressions
                                        <span class="pull-right strong">457</span>
                                        <div class="progress progress-warning progress-striped ">
                                            <div class="bar" style="width: 53%;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon24 icomoon-icon-arrow-up-2 green"></span> 3% Online Users
                                        <span class="pull-right strong">8</span>
                                        <div class="progress progress-danger progress-striped ">
                                            <div class="bar" style="width: 3%;"></div>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>

                    </div><!-- End .box -->  
                </div><!-- End .span4 -->

                <div class="span4">

                    <div class="reminder">
                        <h4>Things you need to do 
                            <a href="#" class="icon tip" title="Configure"><span class="icon16 icomoon-icon-cog-2"></span></a>
                        </h4>
                        <ul>
                            <li class="clearfix">
                                <div class="icon">
                                    <span class="icon32 icomoon-icon-basket gray"></span>
                                </div>
                                <span class="number">7</span> 
                                <span class="txt">Pending Orders</span>
                                <a class="btn btn-warning">go</a>
                            </li>
                            <li class="clearfix">
                                <div class="icon">
                                    <span class="icon32 icomoon-icon-support red"></span>
                                </div>
                                <span class="number">3</span> 
                                <span class="txt">Support Tickets </span>
                                <a class="btn btn-warning">go</a>
                            </li>
                            <li class="clearfix">
                                <div class="icon">
                                    <span class="icon32 icomoon-icon-new green"></span>
                                </div>
                                <span class="number">5</span> 
                                <span class="txt">New Invoices </span>
                                <a class="btn btn-warning">go</a>
                            </li>
                            <li class="clearfix">
                                <div class="icon">
                                    <span class="icon32 icomoon-icon-bubbles-2 blue"></span>
                                </div>
                                <span class="number">13</span> 
                                <span class="txt">Review Comments</span> 
                                <a class="btn btn-warning">go</a>
                            </li>
                            <li class="clearfix">
                                <div class="icon">
                                    <span class="icon32 icomoon-icon-cog dark"></span>
                                </div>
                                <span class="number">2</span> 
                                <span class="txt">Settings to Change </span>
                                <a class="btn btn-warning">go</a>
                            </li>                                   
                        </ul>
                    </div><!-- End .reminder -->

                </div><!-- End .span4 -->

            </div><!-- End .row-fluid -->

            <div class="row-fluid">

                <div class="span8">
                    <div class="box calendar gradient">

                        <div class="title">

                            <h4>
                                <span class="icon16 icomoon-icon-calendar"></span>
                                <span>Calendar</span>
                            </h4>
                            <!-- <a href="#" class="minimize">Minimize</a> -->
                        </div>
                        <div class="content noPad"> 
                            <div id="calendar">
                            </div>
                        </div>

                    </div><!-- End .box -->  
                </div><!-- End .span8 --> 

                <div class="span4">

                    <div class="todo">
                        <h4>To Do List <a href="#" class="icon tip" title="Add task"><span class="icon16 icomoon-icon-plus"></span></a></h4>
                        <ul>
                            <li class="clearfix">
                                <div class="txt">
                                    Fix some bugs
                                    <span class="by label">Admin</span>
                                    <span class="date badge badge-important">Today</span>
                                </div>
                                <div class="controls">
                                    <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    <a href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="txt">
                                    Add post about birds
                                    <span class="by label">Julia</span>
                                    <span class="date badge badge-success">Tomorrow</span>
                                </div>
                                <div class="controls">
                                    <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    <a href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="txt">
                                    Remove some items
                                    <span class="by label">Admin</span>
                                    <span class="date badge badge-success">Tomorrow</span>
                                </div>
                                <div class="controls">
                                    <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    <a href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="txt">
                                    Staff party
                                    <span class="by label">Admin</span>
                                    <span class="date badge badge-info">08.08.2012</span>
                                </div>
                                <div class="controls">
                                    <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    <a href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="txt">
                                    Shedule backup
                                    <span class="by label">Steve</span>
                                    <span class="date badge badge-info">08.08.2012</span>
                                </div>
                                <div class="controls">
                                    <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    <a href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div><!-- End .span4 -->

                <div class="span4">

                    <div class="box gradient">
                        <div class="title">
                            <h4>
                                <span class="icon16 icomoon-icon-bubbles-6"></span>
                                <span>Messages layout</span>
                            </h4>
                        </div>
                        <div class="content noPad">

                            <ul class="messages">
                                <li class="user clearfix">
                                    <a href="#" class="avatar">
                                        <img src="/style/admin/image/avatar2.jpeg" alt="user" />
                                    </a>
                                    <div class="message">
                                        <div class="head clearfix">
                                            <span class="name"><strong>Lazar</strong> says:</span>
                                            <span class="time">25 seconds ago</span>
                                        </div>
                                        <p>
                                            Time to go i call you tomorrow.
                                        </p>
                                    </div>
                                </li>
                                <li class="admin clearfix">
                                    <a href="#" class="avatar">
                                        <img src="/style/admin/image/avatar3.jpeg" alt="user" />
                                    </a>
                                    <div class="message">
                                        <div class="head clearfix">
                                            <span class="name"><strong>Sugge</strong> says:</span>
                                            <span class="time">just now</span>
                                        </div>
                                        <p>
                                            OK, have a nice day.
                                        </p>
                                    </div>
                                </li>

                                <li class="sendMsg">
                                    <form class="form-horizontal" action="#">
                                        <textarea class="elastic" id="textarea" rows="1" placeholder="Enter your message ..." style="width:98%;"></textarea>
                                        <button type="submit" class="btn btn-info marginT10">Send message</button>
                                    </form>
                                </li>

                            </ul>

                        </div>

                    </div><!-- End .box -->


                </div><!-- End .span4 -->

            </div><!-- End .row-fluid -->

            <div class="modal fade hide" id="myModal1">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                    <h3>Chat layout</h3>
                </div>
                <div class="modal-body">
                    <ul class="messages">
                        <li class="user clearfix">
                            <a href="#" class="avatar">
                                <img src="/style/admin/image/avatar2.jpeg" alt="" />
                            </a>
                            <div class="message">
                                <div class="head clearfix">
                                    <span class="name"><strong>Lazar</strong> says:</span>
                                    <span class="time">25 seconds ago</span>
                                </div>
                                <p>
                                    Time to go i call you tomorrow.
                                </p>
                            </div>
                        </li>
                        <li class="admin clearfix">
                            <a href="#" class="avatar">
                                <img src="/style/admin/image/avatar3.jpeg" alt="" />
                            </a>
                            <div class="message">
                                <div class="head clearfix">
                                    <span class="name"><strong>Sugge</strong> says:</span>
                                    <span class="time">just now</span>
                                </div>
                                <p>
                                    OK, have a nice day.
                                </p>
                            </div>
                        </li>

                        <li class="sendMsg">
                            <form class="form-horizontal" action="#">
                                <textarea class="elastic" id="textarea1" rows="1" placeholder="Enter your message ..." style="width:98%;"></textarea>
                                <button type="submit" class="btn btn-info marginT10">Send message</button>
                            </form>
                        </li>

                    </ul>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
            </div>

        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

</div><!-- End #wrapper -->

<?php endif; ?>