<?php if(!empty($result)){
foreach ($result as $key => $row) {
?>
<li class="list-group-item">
	<label class="i-checkbox i-checkbox--tick i-checkbox--success wz-m-b-0">
		<input type="checkbox" class="check-item" name="id[]" value="<?php waziper_e( waziper_get_data($row, 'ids') )?>">
		<span></span>
	</label>
	<?php waziper_e( $row->phone )?>		
</li>
<?php }}else{
	if($page == 0){
?>
<div class="waziper-empty wz-m-t-100 wz-m-b-100">
	<div class="icon"></div>
</div>
<?php }}?>