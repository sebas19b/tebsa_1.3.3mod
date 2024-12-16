var pag="capaproduc",pagnext,timer=null;
function transition(ed){
 pagnext=ed.getAttribute("href");
 pagnext=pagnext.slice(1);
    if (pag!="capaproduc"){        
        document.getElementById(pag).style.top=-100+'%';
    }
    	document.getElementById('capaproduc').style.opacity='0';
   if(pagnext!=pag){ 
   	  if(pagnext=='capaproduc'){	  
   	  	 document.getElementById('capaproduc').style.opacity='1';
   	  }
      document.getElementById(pagnext).style.top=4+'%';
      pag=pagnext;
   }
}
function transitionHome(ed){
 pagnext=ed.getAttribute("href");
 pagnext=pagnext.slice(1);
  if(pagnext==pag){
     document.getElementById(pag).style.top=-100+'%';
     document.getElementById('capaproduc').style.opacity='1';
     pag="capaproduc";
  }else{
    if (pag!="capaproduc"){        
        document.getElementById(pag).style.top=-100+'%';
    }
      document.getElementById('capaproduc').style.opacity='0';
   if(pagnext!=pag){ 
      if(pagnext=='capaproduc'){    
         document.getElementById('capaproduc').style.opacity='1';
      }
      document.getElementById(pagnext).style.top=4+'%';
      pag=pagnext;
   }
  }
}