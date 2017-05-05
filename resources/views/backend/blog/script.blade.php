@section('script')
<script type="text/javascript">
$('ul.pagination').addClass('no-margin pagination-sm');
$('#title').on('blur',function(){
 var theTitle=this.value.toLowerCase().trim(),
 slugInput=$('#slug'),
theSlug=theTitle.replace(/&/g,'-and-')
.replace(/[^a-z0-9-]+/g,'-')
.replace(/\-\-+/g,'-').replace(/^-+|-+$/g, '');

 slugInput.val(theSlug);
});
var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
var simplemde2 = new SimpleMDE({ element: $("#body")[0] });
 $('#datetimepicker1').datetimepicker({
  format:'Y-m-d H:i:s',
  lang:'ru',
  showClear:true
  });
 $('#draft-btn').click(function(e){
  e.preventDefault();
  $('#post-form').submit();
 });
</script>
@endsection