

            <!-- 切り替えタブエリア -->
            <div class="tabbable">
                <ul class="nav nav-tabs main-navigation">
                    <li class="active">
                        <a href="#lend" class="lend" data-toggle="tab">貸している</a>
                    </li>
                    <li>
                        <a href="#borrow" class="borrow" data-toggle="tab">借りている</a>
                    </li>
                </ul>
            </div>

            <!-- 人別表示 -->
            <div class="tab-content">
                
                <section class="tab-pane active" id="lend">
                    <?php if (count($view_data['lend_list']) > 0):?>                    
                        <?php foreach ($view_data['lend_list'] as $lend_list):?>
                            <div class="list-view row-fluid">
                            
                                <div class="span1 checkbox" style="display:none;">
                                    <input type="checkbox" name="lendcheck" value="<?php echo $lend_list['collection_id'];?>">
                                </div>

                                <a href="<?php echo \Uri::base() . 'share/lendandborrow/edit/lend/' . $lend_list['collection_id'];?>">
                                <div class="span11">
                                    <div class="text-left">
                                        <?php echo $view_data['user_friends'][$lend_list['borrow_user_id']]['user_name'];?>さん
                                    </div>
                                    <div>
                                        <?php if (isset($view_data['status']['lend'][$lend_list['status']])):?>
                                            <?php echo $view_data['status']['lend'][$lend_list['status']]?>                                        
                                        <?php endif;?>
                                    </div>
                                    <div>
                                        <?php echo $lend_list['item'];?>円
                                    </div>
                                    <div>
                                        <?php echo $lend_list['date'];?>日に貸しました
                                    </div>
                                </div>
                                </a>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div>
                            貸している物はありません
                        </div>
                    
                    <?php endif;?>
                </section>

                <section class="tab-pane" id="borrow">
                    <?php if (count($view_data['borrow_list']) > 0):?>
                        <?php foreach ($view_data['borrow_list'] as $borrow_list):?>
                            <div class="list-view row-fluid">                            
                                <div class="span1 checkbox" style="display:none;">
                                    <input type="checkbox" name="borrowcheck" value="<?php echo $borrow_list['collection_id'];?>">
                                </div>

                                <a href="<?php echo \Uri::base() . 'share/lendandborrow/edit/lend/' . $borrow_list['collection_id'];?>">
                                <div class="span11">
                                
                                    <div class="text-left">
                                       <?php echo $view_data['user_friends'][$borrow_list['lend_user_id']]['user_name'];?>さん
                                    </div>
                                   <div>
                                       <?php echo $view_data['status']['borrow'][$borrow_list['status']]?>                                        
                                   </div>
                                    <div>
                                       <?php echo $borrow_list['item'];?>円
                                    </div>
                                    <div>
                                       <?php echo $borrow_list['date'];?>日に借りました
                                    </div>
                                </div>            
                                </a>
                            </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div>
                            借りている物はありません
                        </div>                    
                    <?php endif;?>
                </section>
            </div>

