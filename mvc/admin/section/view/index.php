<?php if(!$validate): ?>
    <!-- error fatall or other -->
<?php else: ?>


<!--Body content-->
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3><?= $sections_actual['name'] ?></h3>                    

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
                <li class="active"><?= $sections_actual['name'] ?></li>
            </ul>

        </div><!-- End .heading-->
        
        <div class="row-fluid">
            <div class="span">
                <div class="box">

                    <div class="title">

                        <h4>
                            <span class="icon16 icomoon-icon-equalizer-2"></span>
                            <span>Sections controls</span>
                            
                             
                            
                            <form class="box-form right" action="">
                                <a style="margin-right: 5px;" href="<?= $this->_getUrl() ?>/manager_s/method/add">Добавить</a> 
                                
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="icon16 icomoon-icon-cog-2"></span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><span class="icon-pencil"></span> Скрыть </a></li>
                                    <li><a href="#"><span class="icon-pencil"></span> Отобразить </a></li>
                                    <li><a class="delete" href="#"><span class="icon-trash"></span> Удалить </a></li>
                                </ul>
                            </form>
                            
                        </h4>
                        
                        <a href="#" class="minimize"> Минимизация </a>
                    </div>
                    
                    <div class="content noPad">
                        
                        
                        <table class="table table-bordered" id="checkAll">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>TimeCreated</th>
                                <th>Alias</th>
                                <th>UserID</th>
                                <th>Type</th>
                                <th>ParentID</th>
                                <th>Name</th>
                                <th>Controller</th>
                                <th>Action</th>
                                <th>Url</th>
                                <th>hidden</th>
                                
                                 <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              // var_dump($section_list); die('stop');
                              if(is_array($section_list) and count($section_list) > 0): ?>
                                <?php 
                                $lavel = 1;
                                foreach($section_list as $_key => $_item): ?>
                                    <tr>
                                        <td><?= $lavel ?></td>
                                        <td><?= $_item['TimeCreated'] ?></td>
                                        <td><?= $_item['SectionAlias'] ?></td>
                                        <td><?= $_item['UserID'] ?></td>
                                        <td><?= $_item['SectionType'] ?></td>
                                        <td><?= $_item['SectionParentID'] ?></td>
                                        <td><?= $_item['SectionName'] ?></td>
                                        <td><?= $_item['SectionController'] ?></td>
                                        <td><?= $_item['SectionAction'] ?></td>
                                        <td><?= $_item['SectionUrl'] ?></td>
                                        <td><?= $_item['hidden'] ?></td>
                                        <td class="chChildren"><input type="checkbox" name="checkbox" value="1" class="styled" /></td>
                                        <td>
                                            <div class="controls center">
                                                <a href="#" title="Edit task" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                                <a class="delete" href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                            </div>
                                        </td>
                                      </tr>
                                      
                                      <?php
                                      // childs
                                      if(isset($_item['childs']) and !empty($_item['childs'])) :
                                          $this -> renderView('childs', array('childs_list' => $_item['childs'], 'lavel' => $lavel));
                                      endif; 
                                      ?>
                                      
                                <?php endforeach; ?>
                              <?php endif; ?>  
                            </tbody>
                        </table>
                        
                        
                        
                    </div>

                </div><!-- End .box -->
            </div> <!-- End span -->
            
        </div>

    </div><!-- End contentwrapper -->
</div><!-- End #content -->


<?php endif; ?>