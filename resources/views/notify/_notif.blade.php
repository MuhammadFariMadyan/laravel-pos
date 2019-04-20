@if (session()->has('notif.message'))
<script type="text/javascript">
$.notify({
	// options
	message: '{!! session()->get('notif.message') !!}'
},{
	// settings
	type: '{{ session()->get('notif.level')}}'
});
</script>
@endif
