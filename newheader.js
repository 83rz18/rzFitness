// preload images


// initialize image array
var images = new Array()

// load array with images

//for each argument create a new image, assign source as argument text, add numbered id  
function preload() {
    for (i = 0; i < preload.arguments.length; i++) {
        images[i] = new Image();
        images[i].src = preload.arguments[i];
        images[i].id = 'img'+i;
    }
}
// call preload
preload(
    "https://rickyrodriguez.name/image/rzGold.png"
)
//when document is loaded
$( document ).ready(function() {
    //newHeadE()
    newHeadE  = function(tag,type,rl,hf,cs) {
        e = top.document.createElement(tag);
   	e.type = type;
   	e.rel = rl;
   	e.href = hf;
   	e.className=cs;
   	document.head.appendChild(e);
    }
    newBodyE  = function(tag,hash,cls) {
        e = document.createElement(tag);
     	e.id = hash;
     	e.className=cls;
     	document.body.appendChild(e);
    }
    csSheet = function(text){
        var ta = document.createTextNode(text);
       	document.head.getElementsByTagName('style')[0].appendChild(ta);
    }  
    cssRule = function(sel,attr,val){            	
        if(sel[0] == '#'){
       	    //console.log(sel[0], sel.slice(1));
            document.getElementById(sel.slice(1)).style[attr] = val;
        }else if(sel[0] == '.'){//for each!!!!
            var elements = document.body.getElementsByClassName(sel.slice(1));
           // console.log(elements, sel[0], sel.slice(1));
      
            
           
        }else{
            for (let i of document.getElementsByTagName(sel)) {
               // console.log(sel);
           	i.style[attr] = val;
            } 
        }
    };
    newForm = function(parent, id, putOne, putTwo){
    
        //convert agruments into array 
        let args =  Array.from(arguments);
        console.log(args.slice(2))
        
    	frm = document.createElement('form');
     	frm.id = id;
     	frm.action = 'index.php';
     	document.getElementById(parent).appendChild(frm);
     	for(i in args.slice(2)){
     	    if (args.slice(2)[i]!=undefined){
     	        put = document.createElement('input');
     	        put. id = args.slice(2)[i];
     	        put.type = args.slice(2)[i];
     	        put.value = args.slice(2)[i];
     	        put.name = args.slice(2)[i];
     	        document.getElementById(id).appendChild(put);
     	    }
     	    
     	}
     	sub = document.createElement('input');
    	sub.type = 'submit';
     	sub.id = 'submit'+id;
     	sub.value = id;
     	document.getElementById(id).appendChild(sub);
    	
    }
 			
    //HEAD 
    newHeadE('link','image/x-icon','shortcut icon','https://rickyrodriguez.name/image/rzRepeat1.png','');
    document.title = ' | Index'; 
    newHeadE('style','text/css');  			
    //body .fixed
    csSheet(" .fixed{position:fixed}");
    cssRule('body','fontfamily',"'Raleway',sans-serif");
    cssRule('body','width',"95vw");
    cssRule('body','height',"200vh");
    cssRule('body','margin',"0vh");
    cssRule('.fixed','position',"fixed");
   
    newBodyE('div','navOne','nav fixed');
    newBodyE('div','navTwo','nav fixed');
    //.nav #navOne #navTwo
    csSheet('input{border:none}.nav{transition:top .5s;margin:0;width:99.55vw;height:10vh}#navOne{background:linear-gradient( to right,rgba(255,255,255,0.75),rgba(255,255,255,0.5),rgba(255,255,255,0.5),rgba(255,255,255,0.75)),linear-gradient(  #575959, white)}#navTwo{background:linear-gradient(to right, #575959,rgba(0,0,0,0),rgba(0,0,0,0),rgba(0,0,0,0), #575959),/**/linear-gradient(  #353737,#575959,#575959,#575959, #353737);top:10vh}');
     

    
            
    document.body.appendChild(images[0]);
    document.getElementById('img0').className='fixed';
    csSheet('#img0{transition:top .5s,height .5s;height:10vh;top:5.45vh;left:5.45vh}');     
    
    
    newForm('navTwo', 'Create An Account'); 
    cssRule('#submitCreate An Account','float','right')
    cssRule('#submitCreate An Account','background','transparent')
    cssRule('#submitCreate An Account','height','10vh')
    cssRule('#submitCreate An Account','width','calc(25vw/2*3)')
    cssRule('#submitCreate An Account','margin-right','4.45vh')
    cssRule('#submitCreate An Account','color','rgba(255,255,255,0.75')
    cssRule('#submitCreate An Account','background-color','rgba(255,94,0,0.1')
    

    //cssRule('#submitCreate An Account','background','linear-gradient( to right,rgba(255,255,255,0.75),rgba(255,255,255,0.5),rgba(255,255,255,0.5),rgba(255,255,255,0.75)),linear-gradient(  #575959, white)')
    
    
    
    newForm('navOne', 'Log In', 'password', 'username');
    cssRule('#username','text-align','center')
    cssRule('#password','text-align','center')
    cssRule('#Log In','float','right')
    cssRule('#Log In','margin-top','0vh')
    cssRule('#Log In','margin-right','4.45vh')
    cssRule('#Log In','width','99vw')
    cssRule('#username','height','10vh')
    cssRule('#password','height','10vh')
    cssRule('#username','background-color','rgba(0,255,255,0.09)')
    cssRule('#password','background-color','rgba(0,255,255,0.09)')
    
    



    
    cssRule('#username','width','calc(25vw/2)')
    cssRule('#password','width','calc(25vw/2)')
    cssRule('#password','float','right')
    cssRule('#username','float','right')
    cssRule('#submitLog In','float','right')
    cssRule('#submitLog In','background','transparent')
    cssRule('#submitLog In','height','10vh')
    cssRule('#submitLog In','width','calc(25vw/2)')
    cssRule('#submitLog In','color','#353737')
    cssRule('#submitLog In','background-color','rgba(0,255,255,0.15)')
    //cssRule('#submitLog In','background','linear-gradient(to right, #575959,rgba(0,0,0,0),rgba(0,0,0,0),rgba(0,0,0,0), #575959),linear-gradient(  #353737,#575959,#575959,#575959, #353737)')
    //cssRule('#username','background','linear-gradient(to right, #575959,rgba(0,0,0,0),rgba(0,0,0,0),rgba(0,0,0,0), #575959),linear-gradient(  #353737,#575959,#575959,#575959, #353737)')
    //cssRule('#password','background','linear-gradient(to right, #575959,rgba(0,0,0,0),rgba(0,0,0,0),rgba(0,0,0,0), #575959),linear-gradient(  #353737,#575959,#575959,#575959, #353737)')
    
   

    
    
    
   //scroll ;
    // Create cross browser requestAnimationFrame method:
    window.requestAnimationFrame = window.requestAnimationFrame
    || window.mozRequestAnimationFrame
    || window.webkitRequestAnimationFrame
    || window.msRequestAnimationFrame
    || function(f){setTimeout(f, 1000/60)}
    function scroll(){
       csSheet('.closed{left:110vw}')
       var pos = window.pageYOffset ;
       if (pos<=50){
 	        document.getElementById('navOne').style.top='0vh';
 		document.getElementById('navTwo').style.top='10vh';
 		document.getElementById('img0').style.top='5.45vh';
 		document.getElementById('img0').style.height='10vh';
       }else{
 		document.getElementById('navOne').style.top='-10vh';
 		document.getElementById('navTwo').style.top='0vh';
 		document.getElementById('img0').style.top='1.91vh';
     		document.getElementById('img0').style.height='6.18vh';
       }
    }
    window.addEventListener('scroll', function(){requestAnimationFrame(scroll)}, false)
    $(window).resize(scroll);
});    	
