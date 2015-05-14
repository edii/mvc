
<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3><?php // $sections_actual['name'] ?></h3>                    

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
                <li class="active"><?php // $sections_actual['name'] ?></li>
            </ul>

        </div><!-- End .heading-->

        <div class="row">
            <div class="col-lg-12">
            <!-- FILTERS -->
            <div class="row-fluid">
                <div class="boxFilters text-center">
                    <a class="btn btn-default" href="<?= $this->_getUrl() ?>/manager/method/add">Добавить</a>
                </div>
            </div>
            <!-- END -->
            <div class="row-fluid">
                <div class="span6">

                    <div class="box">

                        <div class="title">

                            <h4>
                                <span class="icon16 icomoon-icon-equalizer-2"></span>
                                <span>With action buttons</span>
                            </h4>
                            <a href="#" class="minimize">Minimize</a>
                        </div>
                        <?php
//                            echo "<pre>";
//                            var_dump( $products );
//                            echo "</pre>";
                        ?>
                        
                        <div class="content noPad">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>alias</th>
                                    <th>name</th>
                                    <th>timeCreated</th>
                                    <th>timeSaved</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($products as $product): ?>  
                                  <tr>
                                    <td><?= $product -> id ?></td>
                                    <td><?= $product -> alias ?></td>
                                    <td><?= $product -> name ?></td>
                                    <td><?= $product -> timeCreated ?></td>
                                    <td><?= $product -> timeSaved ?></td>
                                    <td>
                                        <div class="controls center">
                                            <a href="<?= $this->_getUrl() ?>/manager/method/edit/id/<?= $product -> id ?>" title="Edit task" class="tip">
                                                <span class="icon12 icomoon-icon-pencil"></span>
                                            </a>
                                            <a href="<?= $this->_getUrl() ?>/manager/method/delete/id/<?= $product -> id ?>" title="Remove task" class="tip">
                                                <span class="icon12 icomoon-icon-remove"></span>
                                            </a>
                                        </div>
                                    </td>
                                  </tr>
                                  <?php endforeach; ?>
                                </tbody>
<!--                                <tfoot> 
                                  <tr>
                                    <th>#</th>
                                    <th>alias</th>
                                    <th>name</th>
                                    <th>timeCreated</th>
                                    <th>timeSaved</th>
                                    <th>Action</th>
                                  </tr>
                                </tfoot>-->
                            </table>
                        </div>

                    </div><!-- End .box -->

                </div><!-- End .span6 -->
            </div>
            
            </div>
        </div>
    </div>
</div>    