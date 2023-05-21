<?php  if(!empty($data) || count($data) > 0){ ?>
                       <div class="box-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="exm">
                              <thead>
                                <tr>


                              <th>Makrs</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php
                                for($i=0; $i< count($data);$i++){ ?>
                                    <tr>

                                    <td><?php

                                    $marks_data=explode(',',$data[$i]->marks_list);  ?>

                                   <table class="table table-striped table-bordered">
                                  <?php  for($j=0;$j<count($marks_data);$j++){
                                        $dt=explode('-',$marks_data[$j]);
                                        ?>

                                        <tr>
                                        <td><?php echo $dt[0]; ?></td>
                                        <td><?php echo $dt[1]; ?></td>
                                        </tr>

                                    <?php  } ?>
                                    </table>


                                    </td>
                                    <tr>
                              <?php  } ?>


                              </tbody>
                            </table>

                        </div>
                      <?php }else{ ?>
                        <div style="text-align: center;">
                          <span style="color: red;">Result Not Released Yet.Please try agian after some time.</span>
                      </div>

            <?php  } ?>
