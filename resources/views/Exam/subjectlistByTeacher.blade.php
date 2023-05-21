<div class="box box-primary">
         <div class="box-header with-border">
           <h3 class="box-title">Subject List </h3>
         </div>
          <div class="box-body">
            <div class="col-md-12">
              <p>Click on subject to download result</p>
            </div>
            <?php foreach ($subjects as $key => $value) { ?>
              <div class="col-md-3">
                <div class="form-group">
                  <a href="{{url('exam/download/result/'.$value->subject.'/'.$value->course.'/'.$value->batch.'/'.$value->acadmic_year.'/'.$value->emp_id)}}" class="btn btn-info subs" id="<?php echo $value->subject."|".$value->course."|".$value->batch."|".$value->acadmic_year; ?>"><?php echo $value->subject_name; ?></a>
                </div>
              </div>
        <?php } ?>
          </div>
        </div>
<script>
 $(document).ready(function () {
    $(".sub").click(function(){
      alert(this.id);
      var _url = $("#_url").val();
    });
 });
</script>
