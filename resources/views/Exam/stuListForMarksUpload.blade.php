<div class="box box-info">
         <div class="box-header with-border">
           <h3 class="box-title">Student List</h3>
			<br> <div style="text-align:center;font-size:larger;">
				 <?php if($submit_status==1){ ?>
					<span style='color:green;text-decoration:underline;'>Final Marks Submitted.</span>
				<?php	}else{ ?>
					 <span style='color:red;text-decoration:underline;'>Final Marks Not Submitted.</span>
				<?php	} 
			 ?>
			 </div>
           <div style="float: right;">
             <a id="<?php echo $subject; ?>" class="final_submit btn  <?php if($submit_status==1){echo "btn-success";}else{echo "btn-warning";} ?>">Final Submit</a>
             <a  name="<?php echo $subject; ?>" class="btn download btn-info">Download</a>
           </div>
         </div>
          <div class="box-body">
            <input type="hidden" id="submit_status" value="{{$submit_status}}" disabled readonly/>
          @if(count($student) > 0)
          <table class="table table-striped table-bordered" id="exm">
                <thead>
                <tr>
                <th>Sl.No</th>
                <th>Reg No.</th>
                <th>Student</th>
                <th>Roll No</th>            
                <th>Makrs @if($sub_type=='No') ({{$exam_details[0]->fullmarks}}) @endif</th>
                <th>Attendance (Click here For Absent)</th>
                </tr>
                </thead>
                <tbody>
                  @php $i=0; @endphp
                  @foreach($student as $key=>$value)
                  @php $i++; @endphp
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$value->reg_no}}</td>
                    <td>{{$value->stu_name}}</td>
                    <td>{{$value->roll_no}}</td>               
                    <td><input type="text" <?php if($submit_status==1){echo "readonly";} ?>
                      class="mark form-control" <?php if(isset($value->marks) && $value->marks != "NA"){echo "readonly";} ?>
                      value="{{$value->marks}}"  <?php if($sub_type=='No'){ ?> max="{{$exam_details[0]->fullmarks}}" <?php } ?>
                     <?php if($sub_type=='No'){ ?>  onkeypress="return isNumberKey(event)" <?php } ?>
                      id="<?php echo $value->roll_no."|".$value->reg_no."|".$value->stu_name."|".$subject."|".$value->id; ?>"
                      /></td>
                    <td><span max="{{$exam_details[0]->fullmarks}}" id="<?php echo $value->roll_no."|".$value->reg_no."|".$value->stu_name."|".$subject."|".$value->id; ?>" class="changeButton" style="<?php if($value->marks=="AB"){ echo "color:red;"; }else "color:green;"; ?>cursor:pointer;text-align: left;"><?php echo $value->marks=="AB" ?  "Absent" :  "Present" ?>  </span></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div>
                <h5>Student Not Found.</h5>
              </div>
            @endif

          </div>
        </div>
<script src="{{ URL::asset('assets/bower_components/jquery/dist/bootbox.min.js') }}"></script>
        <script>
        $(document).ready(function(){

          $(".download").on("click",function(e){
            e.preventDefault();
            var subject=$(this).attr("name");
            ///alert(subject);
            var cid=$("#courses").val();
            var bid=$("#batch").val();
            var academic_year=$("#session").val();
            var exam_id=$("#exam_id").val();
            var _url = $("#_url").val();
            window.location.href = _url + "/Exam/marks/download/subjectwise/" + subject+"/"+cid+"/"+bid+"/"+academic_year+"/"+exam_id;
          });

          $(".final_submit").on("click",function(){
            //  alert(this.id);
              var subject=this.id;
              var cid=$("#courses").val();
              var bid=$("#batch").val();
              var academic_year=$("#session").val();
              var exam_id=$("#exam_id").val();
              var _url = $("#_url").val();
              bootbox.confirm("Are you sure? After Submit You won't be able to edit marks.", function (result) {
                if (result) {
              $.ajax
              ({
                  type: "POST",
                  url: _url + '/Exam/final_submit',
                  data: {subject:subject,course:cid,batch:bid,academic_year:academic_year,exam_id:exam_id},
                  cache: false,
                  success: function ( data ) {
                  alert(data);
                  location.reload();
                  },
                  error: function (jqXHR, exception) {
       var msg = '';
       if (jqXHR.status === 0) {
           msg = 'Not connect.\n Verify Network.';
       } else if (jqXHR.status == 404) {
           msg = 'Requested page not found. [404]';
       } else if (jqXHR.status == 500) {
           msg = 'Internal Server Error [500].';
       } else if (exception === 'parsererror') {
           msg = 'Requested JSON parse failed.';
       } else if (exception === 'timeout') {
           msg = 'Time out error.';
       } else if (exception === 'abort') {
           msg = 'Ajax request aborted.';
       } else {
           msg = 'Uncaught Error.\n' + jqXHR.responseText;
       }
       alert(msg);
   },
              });
            }
});
          });


          $(".mark").dblclick(function(){
            var submit_status=$("#submit_status").val();
            if(submit_status==1){
              alert("Marks has been submitted to Exam Section.can't Change Now.");
            }else{
              $(this).removeAttr("readonly");
            }
          });

            $(".mark").on("focusout",function(){
              var max_marks=$(this).attr("max")
              //alert(this.value+"|"+max_marks);
              if(parseFloat(this.value) > parseFloat(max_marks)) {
                alert("Please enter valid marks.");
                return false;
              }
              var cid=$("#courses").val();
              var bid=$("#batch").val();
              var session=$("#session").val();
              var data=this.id;
              var marks=this.value;
              var id=$(this).val()+Math.floor(Math.random() * 10);
              $(this).addClass(id);
              var _url = $("#_url").val();
              $.ajax
              ({
                  type: "POST",
                  url: _url + '/Exam/insert_mark_register',
                  data: {data:data,max_marks:max_marks,marks:marks,course:cid,batch:bid,academic_year:session,exam_id:$("#exam_id").val()},
                  cache: false,
                  success: function ( data ) {
                  //  alert(id);
                     $("."+id).prop( "readonly", true);
                      if(data){


                      }else{
                      //  alert(data);
                      }

                  },
                  error: function (jqXHR, exception) {
       var msg = '';
       if (jqXHR.status === 0) {
           msg = 'Not connect.\n Verify Network.';
       } else if (jqXHR.status == 404) {
           msg = 'Requested page not found. [404]';
       } else if (jqXHR.status == 500) {
           msg = 'Internal Server Error [500].';
       } else if (exception === 'parsererror') {
           msg = 'Requested JSON parse failed.';
       } else if (exception === 'timeout') {
           msg = 'Time out error.';
       } else if (exception === 'abort') {
           msg = 'Ajax request aborted.';
       } else {
           msg = 'Uncaught Error.\n' + jqXHR.responseText;
       }
       alert(msg);
   },
              });

            });
        });
        </script>
        <script>
            function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode == 46){
                var inputValue = $("#floor").val();
                var count = (inputValue.match(/'.'/g) || []).length;
                if(count<1){
                    if (inputValue.indexOf('.') < 1){
                        return true;
                    }
                    return false;
                }else{
                    return false;
                }
            }
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
                return false;
            }
            return true;
        }

        </script>
        <script>
        $(document).ready(function(){
          $("#exm").dataTable({
		    responsive:false,
            "scrollX": false
		  });
          $('#exm tbody').on('click', '.changeButton', function () {
             // var table =$('#normal_range_dt').DataTable();
             // table.row( $(this).closest('tr') ).remove().draw();
             var t=$(this).html();
          //    alert(t.search('Present'));
            if(t.search('Present') != -1)
            {
             $(this).html('Absent');
             $(this).css("color","red");
             $(this).css("cursor","pointer");
             $(this).closest('tr').children('td').children(".mark").val('AB');
             $(this).closest('tr').children('td').children(".mark").attr( "readonly");
             var marks="AB";
            }
            else
            {
             $(this).html('Present');
             $(this).css("color","green");
             $(this).css("cursor","pointer");
             $(this).closest('tr').children('td').children(".mark").removeAttr( "readonly");
             $(this).closest('tr').children('td').children(".mark").val('0');
             var marks=0;
            }

            var cid=$("#courses").val();
            var bid=$("#batch").val();
            var session=$("#session").val();
            var data=this.id;
            var max_marks=$(this).attr("max")
          //  alert(data);
          //  var marks=this.value;
          //  alert(marks);
            var id=$(this).val()+Math.floor(Math.random() * 10);
            $(this).addClass(id);
            var _url = $("#_url").val();
            $.ajax
            ({
                type: "POST",
                url: _url + '/Exam/insert_mark_register',
                data: {data:data,max_marks:max_marks,marks:marks,course:cid,batch:bid,academic_year:session,exam_id:$("#exam_id").val()},
                cache: false,
                success: function ( data ) {
                //  alert(id);
                   $("."+id).prop( "readonly", true);
                    if(data){


                    }else{
                     // alert(data);
                    }

                },
                error: function (jqXHR, exception) {
     var msg = '';
     if (jqXHR.status === 0) {
         msg = 'Not connect.\n Verify Network.';
     } else if (jqXHR.status == 404) {
         msg = 'Requested page not found. [404]';
     } else if (jqXHR.status == 500) {
         msg = 'Internal Server Error [500].';
     } else if (exception === 'parsererror') {
         msg = 'Requested JSON parse failed.';
     } else if (exception === 'timeout') {
         msg = 'Time out error.';
     } else if (exception === 'abort') {
         msg = 'Ajax request aborted.';
     } else {
         msg = 'Uncaught Error.\n' + jqXHR.responseText;
     }
     alert(msg);
 },
            });


           });
        });
        </script>
