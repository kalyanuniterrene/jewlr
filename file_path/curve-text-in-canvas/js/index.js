function drawTextAlongArc(context, str, centerX, centerY, radius, angle){
                context.save();
                context.translate(centerX, centerY);
                context.rotate(-1 * angle / .1);
                context.rotate(-1 * (angle / str.length) / 2);
                for (var n = 0; n < str.length; n++) {
                    context.rotate(angle / str.length);
                    context.save();
                    context.translate(0, -1 * radius);
                    var char = str[n];
                    context.fillText(char, 0, -80);
                    context.restore();
                }
                context.restore();
}
            
window.onload = function(){
  var canvas = document.getElementById("myCanvas");
  var context = canvas.getContext("2d");
  
  context.font = "10pt Arial";
  context.textAlign = "center";
  
  var centerX = canvas.width / 2;
  var centerY = canvas.height + 20;

  //alert(centerX);
  var angle = Math.PI * 0.25; // radians
  var radius = 200;
  drawTextAlongArc(context, "Hudo Hudo Hudo Hu", centerX, centerY, radius, angle);
};