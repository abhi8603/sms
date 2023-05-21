<div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student List</h3>
                        </div>

                         <div id="tb" class="box-body">

                       <table class="table table-striped table-bordered display" id="exm">
                             <thead>
                            <tr>
                             <th>Sl. No</th>
                             <th>Student(Reg No.)</th>
                             @foreach($subjects as $key=>$value)
                             <th>{{$value->subject_name}}</th>
                             @endforeach
                              </tr>
                             </thead>
                             <tbody>
                               @php $i=0; @endphp

                                 @foreach($marks as $marks)
                                 <tr>
                                 @php $i++; @endphp
                                 <td>{{$i}}</td>
                                 <td>{{$marks->student_name}} ({{$marks->register_no}})</td>
                                 @foreach($subjects as $key=>$value)
                                @php
                                $m="";
                                $data=explode(',',$marks->marks);
                                @endphp
                                @for($j=0; $j < count($data);$j++)
                                @php
                                    $dt=explode("|",$data[$j]);

                                    $sub_code=isset($dt[0]) ? $dt[0] : null;
                                    $sub_marks=isset($dt[1]) ? $dt[1] :null;

                               @endphp

                                  @if($value->id==$sub_code)
                                    @php $m=$sub_marks @endphp
                                  @else

                                  @endif
                                @endfor
                                <td>@if($m != "")
                                  {{$m}}
                                  @else
                                  <span style="color:red;">Marks Not Sumitted.</span>
                                  @endif
                                </td>
                                 @endforeach
                                 </tr>
                                 @endforeach

                             </tbody>
                           </table>
                         </div>
                        </div>
                        <script>
                        $('#exm').DataTable({
                             "pageLength": 100,
                              autoWidth: false,
                                bDestroy: true,
                                "scrollX": true
                        });
                        </script>
