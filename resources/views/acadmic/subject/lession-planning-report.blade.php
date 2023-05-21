<div class="box box-info">
 <div class="box-header with-border">
 <h3 class="box-title">Lession Planning List</h3>
 </div>
 <div class="box-body">
                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Topic Peroid</th>
                          <th>Topic</th>
                          <th>Objective</th>
                          <th>Duration</th>
                          <th>Teaching Method</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                         @foreach($lessions as $lessions)
                         @php $i++; @endphp
                         <tr>
                         <td>{{$i}}</td>
                         <td>{{$lessions->from_date}} - {{$lessions->to_date}}</td>
                         <td>{{$lessions->topic}}</td>
                         <td>{{$lessions->objective}}</td>
                         <td>{{$lessions->hours_class}}</td>
                         <td>{{$lessions->teaching_methods}}</td>
                         <td>@if($lessions->t_status==0)
                             <span style="color:red;">Pending</span>
                             @else
                               <span style="color:green;">Completed</span>
                             @endif
                        
                        </td>
                        <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default  btn-flat dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu" title="Action">
                                <li><a href="" class='updatestatus' id="{{$lessions->id}}" title="Update Status"><i  class="fa fa-thumbs-up" style="color: #897df8e6";></i></a></li>
                                <li><a href="" class='tFileDelete' id="{{$lessions->id}}" title="Delete"><i class="fa fa-trash" style="color: red";></i></a></li>
                              </ul>
                            </div>
                            </td>
                         </tr>
                         @endforeach
                        </tbody>
                      </table>
                      </div>
                      <script>
$(document).ready(function() {

    $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/subject/lession-planning/delete/" + id;
                    }
                });
            });

            $(".updatestatus").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/subject/lession-planning/update-status/" + id;
                    }
                });
            });

   $.extend($.fn.dataTable.defaults, {
 dom: 'Bfrtip'
});
   $('#example').DataTable( {

       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
         rowReorder: {
           selector: 'td:nth-child(2)'
       },
       responsive: true


   } );
   } );

</script>
 </div>