 
 <? if($flag){$active="active";}else{$active="";}
  $value = '<div class="tab-pane fade '.$active.' in col-lg-12" id="'.$vfLang.'">    <br>';
  $value .= '	<div class="form-group">';
  $value .= '		<label>Title</label><input class="form-control" name="vcTitulo_'.$vfLang.'" value="'.$vcTitulo.'" >';
  $value .= '	</div>';
  $value .= '	<div class="form-group">';
  $value .= '		<label>Price</label><input class="form-control" name="vcPreco_'.$vfLang.'" value="" >';
  $value .= '	</div>';
  $value .= '	<div class="form-group">';
  $value .= '		<label>Description</label>';
  $value .= '		<textarea id="txItens_'.$vfLang.'" name="txItens_'.$vfLang.'" class="form-control" >'.$txTexto.'</textarea>';
  $value .= '	</div>';
  $value .= '	<div class="form-check" style="white-space: nowrap">';
  $value .= '		<input type="checkbox" class="form-check-input" name="vcRecomended_'.$vfLang.'" value="recomended"><label style="padding-left: 0.4em;">Make it recomended</label>';
  $value .= '	</div>';
  $value .= '	<input type="hidden" name="idTrans_'.$vfLang.'" value="'.$vfIdTrans.'">';
  $value .= '	<input type="hidden" name="lang_'.$vfLang.'" value="'.$vfIdLang.'">';
  $value .= '	</div>';
  $value .= '</div>';
  return $value;
  ?>