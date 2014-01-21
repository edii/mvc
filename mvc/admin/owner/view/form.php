<?php if(!$validate): ?>
    <!-- error fatall or other -->
<?php else: ?>

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
        
        <div class="row-fluid">
            <div class="span">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span><?= $title ?></span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal" action="#" method="POST" >
                            <?php if((int)$this->getParam('id')): ?>
                                <input type="hidden" name="id" value="<?= $this->getParam('id') ?>" />
                            <?php endif; ?>
                            <input type="hidden" name="method" value="<?= ($this->getParam('method') == 'edit') ? 'edit': 'add' ?>" />
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Normal field</label>
                                        <input class="span8" id="normalInput" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="focusedInput">Focused input</label>
                                        <input class="span8 focused" id="focusedInput" type="text" value="This is focused…" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="password">Password input</label>
                                        <input class="span8" id="passwordInput" type="password" />
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="tooltip">With tooltip</label>
                                        <input class="span8 tip" id="tooltipInput" type="text" title="This is some tooltip" />
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row row-fluid"> 
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="placeholder">With placeholder</label>
                                        <input class="span8" id="placeholderInput" type="text" placeholder="This is placeholder text" />
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row row-fluid"> 
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4">Read only input</label>
                                        <input class="span8" type="text" readonly="readonly" value="Some value here" />
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="disabledInput">Disabled input</label>
                                        <input class="span8 disabled" id="disabledInput" type="text" placeholder="Disabled input here…" disabled="disabled" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="maxlenght">Max lenght</label>
                                        <input class="span8" id="maxlengthInput" type="text" placeholder="Max lenght 20 characters" maxlength="20"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">
                                            Label hint
                                            <span class="help-block">Some work has to be done</span>
                                        </label>
                                        <input class="span8" id="normalInput1" type="text" />
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="prependedInput">Prepended text</label>
                                        <div class="input-prepend">
                                            <span class="add-on">@</span><input class="span8" id="prependedInput" size="16" type="text" />
                                        </div>
                                        <span class="help-block blue span8">Here's some hint text</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="appendedInput">Appended text</label>
                                        <div class="input-append">
                                            <input class="span8" id="appendedInput" size="16" type="text" /><span class="add-on">.00</span>
                                        </div>
                                        <span class="help-inline blue">Here's more help text</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="appendedInputButton">Append with button</label>
                                        <div class="input-append">
                                            <input class="span8" id="appendedInputButton" size="16" type="text" /><button class="btn" type="button">Go!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="tags">Tags</label>
                                        <div class="span8 controls">
                                            <input id="tags" type="text" value="awesome,nice" style="width:100%;" />
                                        </div>
                                    </div>
                                </div>  
                            </div>  

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Grid fields</label>
                                        <div class="grid-inputs span8">
                                            <input class="span3" type="text" placeholder=".span2" />
                                            <input class="span5" type="text" placeholder=".span4" />
                                            <input class="span8" type="text" placeholder=".span6" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">File input</label>
                                        <input type="file" name="fileinput" id="file" />
                                    </div>
                                </div>  
                            </div>

                                                                    <div class="form-actions">
                               <button type="submit" class="btn btn-info">Save changes</button>
                               <button type="button" class="btn">Cancel</button>
                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

        </div>
        

    </div><!-- End contentwrapper -->
</div><!-- End #content -->

<?php endif; ?>