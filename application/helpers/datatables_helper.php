<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

function datatables_user($id,$username){
	if ($username != 'admin' OR $id != '1') {
		return '
		<td>
			<div class="custom-checkbox custom-control l-27">
			<input type="checkbox" id="checkbox-'.$id.'" class="custom-control-input" name="id[]" value="'.$id.'">
				<label for="checkbox-'.$id.'" class="custom-control-label">&nbsp;</label>
			</div>
		</td> 
		';
	}
}