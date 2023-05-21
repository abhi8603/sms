                       <div class="box-body">                       
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="exm">
                              <thead>
                                <tr>
                              <th>Sl. No</th>
                              <th>Reg No.</th>
                              <th>Roll No</th>
                              <th>Student</th>
                              <th>Class (Section)</th>
                              <th>Makrs</th>                            
                              </tr>
                              </thead>
                              <tbody>
                                <?php
                                for($i=0; $i< count($data);$i++){ ?>
                                    <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $data[$i]->register_no; ?></td>
                                    <td><?php echo $data[$i]->roll_no;; ?></td>
                                    <td><?php echo $data[$i]->student_name; ?></td>
                                    <td><?php echo $data[$i]->course_name ." ( ".$data[$i]->batch_name." )"; ?></td>
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
                                    </tr>
                              <?php  } ?>
                                
                                
                                
                              </tbody>
                            </table>
                         
                        </div>
						   <script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/bower_components/datatables.net-bs/js/dataTables.rowReorder.min.js') }}"></script>
						   <script>
$(document).ready(function() {
	
   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#exm').DataTable( {
       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
   } );
   } );

</script>