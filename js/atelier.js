var stage , layer ;
var selected ;

window.onload = function() {
	stage = new Kinetic.Stage({
		container: "container",
		width: 800,
		height: 600
	});
	layer = new Kinetic.Layer();

	save = function() {
          stage.toDataURL(function(dataUrl) {
			  var dt = dataUrl;
			  dt = dt.replace(/^data:image\/[^;]*/, 'data:application/octet-stream');

				/* In addition to <a>'s "download" attribute, you can define HTTP-style headers */
				dt = dt.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=Canvas.png');
			  var monster_name = document.getElementById("monster_name").value || "mybeautifulmonster";
			  monster_name = monster_name.trim().toLowerCase().replace(/\s/g,'');
			  var saveLink = document.createElement("a")
			saveLink.download = monster_name + ".png"
			saveLink.href = dt;
			saveLink.click();

          });

        }
	
	// add button event bindings
        document.getElementById("toTop").addEventListener("click", function() {
          selected.moveUp();
          layer.draw();
        }, false);

        document.getElementById("toBottom").addEventListener("click", function() {
          selected.moveDown();
          layer.draw();
        }, false);
        
        document.getElementById("rotateplus").addEventListener("click", function() {
          selected.rotate(0.1);
          layer.draw();
        }, false);
        
        document.getElementById("rotateminus").addEventListener("click", function() {
          selected.rotate(-0.1);
          layer.draw();
        }, false);
        
        
        document.getElementById("sizeplus").addEventListener("click", function() {
		  var ratio = selected.getHeight()/selected.getWidth();	
          selected.setWidth(selected.getWidth()+2);
          selected.setHeight(selected.getHeight()+2*ratio);
          layer.draw();
        }, false);
        
        document.getElementById("sizeminus").addEventListener("click", function() {
		  var ratio = selected.getHeight()/selected.getWidth();	
          selected.setWidth(selected.getWidth()-2);
          selected.setHeight(selected.getHeight()-2*ratio);
          layer.draw();
        }, false);
        
        
       document.getElementById("save").addEventListener("click", save, false);
        
       document.getElementById("erase").addEventListener("click", function() {
		   stage.reset();
		
        }, false);
        
        
};


function addPart(aPart){
	var imageObj = new Image();
	
	imageObj.src = aPart.src;
	
	var w = imageObj.width ;
	var h = imageObj.height ;
	var image = new Kinetic.Image({
		x: stage.getWidth() / 2 - w/2,
		y: stage.getHeight() / 2 - h/2,
		image: imageObj,
		width: w,
		height: h,
		draggable:true,
	});
	selected = image ;

	// add the shape to the layer
	layer.add(image);

	// add the layer to the stage
	stage.add(layer);
	
	image.on("click mousedown", function() {
	selected = image ;
	});
	
	image.on("dblclick", function() {
		layer.remove(image);
		layer.draw();
		selected=null;
	});
	
}


function getAllParts(whatPart) {
	var res = "";
	var xmlDoc = loadXMLDoc("resources/resources.xml");
	
	var path = "/parts/part[@categorie='"+whatPart+"']/@src";
	var nodes = xmlDoc.evaluate(path,xmlDoc, null, XPathResult.ANY_TYPE,null);
	var result=nodes.iterateNext();

	while (result){
		 var nom = result.nodeValue ; 
		res+= "<img src='resources/"+nom+"' alt='"+nom+"' title='"+nom+"' class='monster_membre'  onclick='addPart(this)' />";
		result=nodes.iterateNext();
	}
	document.getElementById("drop_part").innerHTML=res;
	
}    
    
