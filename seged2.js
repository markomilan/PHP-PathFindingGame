let Fomodel;
let kezdo={x:99,y:99};
let vege={x:98,y:98};
let szin="";
let eventek=[];
let osszeventek=[];
let nyert=0;


function tabla(model) {
  nyert=0;
  Fomodel=model;
  const tabla = model;
  let tablaTorzs = "" ;
  for (let sor of tabla) {
      tablaTorzs += '<tr>';
      for (let oszlop of sor) {
          if(oszlop>0){
            tablaTorzs += '<td class="rajzolt">';
            tablaTorzs +=oszlop;
          }else{
            tablaTorzs += '<td>';
          }
          tablaTorzs += '</td>';
      }
      tablaTorzs += '</tr>';
  }
  
  return tablaTorzs;
}

function xyCoord(event) {
  const cella = event.target;
  const sor = event.target.parentElement;
  const x = sor.sectionRowIndex;
  const y = cella.cellIndex;
  return { x: x, y: y };
}

function nyerte(){
  let max=0;
  for(let sor of Fomodel){
    for(let oszlop of sor){
      if(oszlop!=0 && oszlop>max){
        max=oszlop;
      }
    }
  }
  if(max==osszeventek.length && nyert==0){
    confirm("nyertel");
    nyert=1;
    $(function(){
      let xhr = new XMLHttpRequest();
      xhr.open('GET','sikerespalya.php',false);
      xhr.send(null);
    });
    
}
}
/*$(function(){
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let myObj = JSON.parse(this.responseText);
          myObj.felhasznalok["nev@valami.hu"].megoldottak.push("1");

          this.responseText=JSON.stringify(myObj);
          console.log(this.responseText);
        }
      };
      xmlhttp.open("POST", "adatok.json", true);
      xmlhttp.send();
});*/

/*$(function(){
      $.ajax({
        type: 'GET',
        url:'help.php',
        dataType: 'json',
        data: {variablename: 100},
        success: function(data){
          alert(data);
          alert("naa");
        },
        error:function(){
          alert("nem");
        }
      });
  });*/

/*$(function(){
      var ez = "szia";
      $.ajax({
        type : "POST",
        url: "help.php",
        success: function(ez){
          alert(ez);
        }
      });
  });
  $(function () {
    var datas ="szia";
    $.get("palyaindit.php",datas,function(){
      console.log("ez");
    });
  });*/


/*if(nyerte()){
  $(function(){
      $.ajax({
        type: 'POST',
        url:'palyaindit.php',
        dataType: 'html',
        data: {a: '1'},
        success: function(data){
          alert(data.a);
          alert("naa");
        },
        error:function(){
          alert("nem");
        }
      });
  });
}*/

delegate(document.getElementById('entabla'),"mousedown","td",elsoszin);

function elsoszin(event){
  let koordinatak=xyCoord(event);
  let cell=Fomodel[koordinatak.x][koordinatak.y];
  if(event.target.style.background==""){
    switch(cell){
      case 1:
        event.target.style.background="red";
        break;
      case 2:
        event.target.style.background="blue";
        break;
      case 3:
        event.target.style.background="orange";
        break;
      case 4:
        event.target.style.background="green";
        break;
      case 5:
        event.target.style.background="yellow";
        break;
      case 6:
        event.target.style.background="purple";
        break;
      case 7:
        event.target.style.background="pink";
        break;
      case 8:
        event.target.style.background="darkgrey";
        break;
      case 9:
        event.target.style.background="lightblue";
        break;
      case 10:
        event.target.style.background="magenta";
        break;
      case 11:
        event.target.style.background="sienna";
        break;
      default:
        break;
    }
    if(cell!=0){
      kezdo=koordinatak;
      eventek.push(event);
      szin=event.target.style.background;
      document.getElementById('entabla').addEventListener('mouseover', szinez);
    }
  }
}

function szinez(){
  let koordinatak=xyCoord(event);
  if(Fomodel[koordinatak.x][koordinatak.y] == 0 ) {
    event.target.style.background=szin;
    eventek.push(event);
  }
}

delegate(document.querySelector("#entabla"),"mouseup","td",utolsoszin);
/*document.querySelector("#entabla").addEventListener('mouseup',()=>{
  event.preventDefault();
  let xhr = new XMLHttpRequest();
  xhr.open('POST','palyaindit.php?action=seged',false);

});*/

function utolsoszin(event){
  document.getElementById('entabla').removeEventListener("mouseover",szinez);
  vege=xyCoord(event);
  if(kezdo.x <90 && vege.x <90){
    if((kezdo.x!=vege.x || kezdo.y!=vege.y) && Fomodel[vege.x][vege.y]==Fomodel[kezdo.x][kezdo.y]){
      event.target.style.background=szin;
      eventek.push(event);
      osszeventek.push(eventek);
      
    }
    else{
      for(let i=0;i<eventek.length;++i){
        eventek[i].target.style.background="";
      }
    }
}
  eventek=[];
  szin="";
  nyerte();
  kezdo={x:99,y:99};
  vege={x:98,y:98};
}