function funGenerateTooltips(){
  var elements = document.getElementsByClassName("tooltip-img");
  var len = elements.length;
  var viTooltip = '';
  for (var i = 0; i < len; i++) {
    viTooltip = '<a class="href-tooltip">';
    viTooltip += '  <div style="display:inline-block" class="border-boxed">';
    viTooltip +=      elements[i].getAttribute("tooltip-pos");
    viTooltip += '  </div>';
    viTooltip += '  <div class="wrapper-tooltip">';
    viTooltip += '    <img src="' + elements[i].getAttribute("tooltip-path") + '" class="img-responsive absolute-img"/>';
    viTooltip += '  </div>';
    viTooltip += '</a>';
    $(elements[i]).append(viTooltip);
  }
}
