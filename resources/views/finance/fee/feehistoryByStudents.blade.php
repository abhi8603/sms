<div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fee details</h3>
                        </div>

                         <div id="tb" class="box-body">

                       <table id="feeinfo" class="table table-striped table-bordered" style="font-size: smaller;text-align: center;">
                             <thead>
                            <tr>
                             <th>Academic Year</th>
                             <th>Receipt no</th>
                             <th style="text-align:center">Fee details</th>
                             <th>Total Amount</th>
                             <th>Pay Mode</th>
                             <th>Pay Status</th>
                             <th>Bank Ref. No</th>
                             <th>Collected By</th>
                             <th>Action</th>
                              </tr>
                             </thead>
                             <tbody>
                               @php $i=0; @endphp

                                 @foreach($data as $data)
                                 <tr>
                                 @php $i++; @endphp
                                 <td>{{$data->acadmic_year}}</td>
                                 <td>{{$data->receipt_no}}</td>
                                 <td>
                                   <?php
                                   $fees=explode(',',$data->fees); ?>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Fee Head</th>
                                        <th>Amount</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Fee Status</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                    <?php
                                    $k=0;$j=0;
                                  for($i=0;$i < count($fees);$i++){

                                  //  print_r($fees[$i]);
                                    $fee=explode("|",$fees[$i]);
                                    if($fee[4]==0){$k++;}
                                    if($fee[4]==1){$j++;}
                                   ?>
                                     <tr>
                                        <td><?php echo $fee[0] ?></td>
                                        <td><?php echo $fee[1] ?></td>
                                        <td><?php echo $fee[2] ?></td>
                                        <td><?php echo $fee[3] ?></td>
                                        <td><?php echo $fee[4]==0 ? "Not Paid": "Paid";?></td>
                                      </tr>
                              <?php    }?>
                            </tbody>

                            </table>
                                 </td>
                                 <td>{{$data->sum_amt}}</td>
                                 <td>{{$data->pay_mode}}</td>
                                 <td><?php echo  $k > 0 && $j > 0 ?"Partial Paid" : $data->receipt_status ; ?></td>
                                 <td>{{$data->bank_ref_no}}</td>
                                 <td>{{$data->collected_by}}</td>
                                 <td><a href="{{url('finance/feeCollection/receipt/'.$data->receipt_no)}}" class="btn btn-warning" target="_blank">View Receipt</a></td>
                                 </tr>
                                 @endforeach

                             </tbody>
                           </table>
                         </div>
                        </div>
                        <script>
                           $('#feeinfo').DataTable();                     

                        </script>