import color from './backgroundColor.json' assert {type: 'json'};

$(document).ready(function(){

  for(let i = 0; i < color.length; i++) {
    console.log(color[i].bc);
}
  
  $('.color').css({"background-image" : color[15].bc});

});

