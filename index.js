let model={tabla};
let kezdo={x:99,y:99};
let vege={x:98,y:98};
let szin="";
let eventek=[];
let osszeventek=[];

function tabla(model) {
    const tabla = model.tabla;
    let tablaTorzs = "" ;
    for (let sor of tabla) {
        tablaTorzs += '<tr>';
        for (let oszlop of sor) {
            if(oszlop>0){
              tablaTorzs += '<td class="nev">';
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

const kuldoncok = document.querySelector('#kuldoncok');
const entabla = document.querySelector('#entabla');



function ujJatek() {
    // Modell kezdeti állapotba állítása
    osszeventek=[]
    let nehezs=document.querySelector("#nehezseg").value;
    if (typeof nehezs === 'undefined' || nehezs === null) {
      //model = { tabla=ujtabla};
    }else{
      if(nehezs=="konnyu"){
        model = {
            tabla: [
              [0,0,0,2,0],
              [0,1,0,0,0],
              [0,0,2,0,0],
              [3,0,0,3,0],
              [1,0,0,0,0],
            ]
          };
      }else if(nehezs=="kozepes"){
        model = {
          tabla: [
            [2,0,0,9,0,0,0,5,0],
            [1,0,0,8,0,11,0,0,5],
            [0,2,0,0,6,0,7,0,0],
            [0,0,0,0,0,11,0,10,0],
            [0,0,0,7,0,0,0,0,0],
            [0,0,0,4,0,0,0,0,0],
            [0,0,0,0,0,0,0,3,6],
            [0,9,0,4,8,0,0,0,0],
            [0,1,0,0,0,0,0,10,3],
          ]
        };
      }else{
        model = {
          tabla: [
            [1,0,0,0,3,0,5,0,2],
            [0,0,0,0,0,0,8,5,0],
            [7,4,0,6,0,0,0,0,0],
            [0,0,0,0,0,0,1,0,0],
            [0,0,0,0,0,0,0,0,2],
            [0,0,4,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0],
            [0,7,0,0,0,0,3,0,0],
            [0,0,0,6,0,0,0,0,8],
          ]
        };
      }
  }
    entabla.innerHTML = tabla(model);
  }

function xyCoord(event) {
  const cella = event.target;
  const sor = event.target.parentElement;
  const x = sor.sectionRowIndex;
  const y = cella.cellIndex;
  return { x: x, y: y };
}


function nyerte(){
  if(model.tabla[0].length==5){
    if(osszeventek.length==3){
      confirm("nyertel");
    }
  }
  else if(model.tabla[0][0]==1){
    if(osszeventek.length==8){
      confirm("nyertel");
    }
  }
  else{
    if(osszeventek.length==11){
      confirm("nyertel");
    }
  }
}

/*function betoltes(){
  model=getsuti("model");
  osszeventek=getsut("osszeventek");
}


function getsuti(nev){
  let retval = {};
  retval.talalt = false;
  retval.ertek = '';
  
  let dekodoltSuti = decodeURIComponent(document.cookie);
  let sutik = dekodoltSuti.split(';');

  let i = 0;
    while(i < sutik.length && !retval.talalt){
        let sutiBontva = sutik[i].split('=');
        retval.talalt = (sutiBontva[0].trim() == nev);
        if(retval.talalt){                                                                                                         
            retval.ertek = sutiBontva[1];
        }
        i++;
    }
    return retval;
}

function felulir(){
  if(document.cookie.length!=0){
    if(confirm("Felul irjam?")){
      return true;
    }else{
      return false;
    }
  }else{
    return true;
  }
}

function mentes(model,osszeventek){
  if(felulir()){
    //console.log(model);
    //console.log(osszeventek)
    document.cookie = ("model =" + model + ";expires=Mon, 9 Dec 2019 00:00:00 UTC;path=/");
    document.cookie = ("osszeventek =" + osszeventek + ";expires=Mon, 9 Dec 2019 00:00:00 UTC;path=/");
  }
}*/

document.querySelector('#uj').addEventListener('click', ujJatek);
//document.querySelector('#mentes').addEventListener('click', mentes(model,osszeventek));
//document.querySelector('#betoltes').addEventListener('click', betoltes);
delegate(document.querySelector("#entabla"),"mousedown","td",elsoszin);
delegate(document.querySelector("#entabla"),"contextmenu","td",jobb);
delegate(document.querySelector("#entabla"),"mouseup","td",utolsoszin);


function jobb(event){
  let aktszin=event.target.style.background;
  let index;
  if(event.target.style.background!=""){
    for(let i=0;i<osszeventek.length;++i){
      for(let j=0;j<osszeventek[i].length;++j){
        if(osszeventek[i][j].target.style.background==aktszin){
          index=i;
          osszeventek[i][j].target.style.background="";
        }
      } 
    }
    osszeventek.splice(index, index+1);
  }
}
  

function utolsoszin(event){
  entabla.removeEventListener("mouseover",szinez);
  vege=xyCoord(event);
  if(kezdo.x <90 && vege.x <90){
    if((kezdo.x!=vege.x || kezdo.y!=vege.y) && model.tabla[vege.x][vege.y]==model.tabla[kezdo.x][kezdo.y]){
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

function szinez(){
  let koordinatak=xyCoord(event);
  if(model.tabla[koordinatak.x][koordinatak.y] == 0 ) {
    event.target.style.background=szin;
    eventek.push(event);
  }
}


function elsoszin(event){
  let koordinatak=xyCoord(event);
  let cell=model.tabla[koordinatak.x][koordinatak.y];
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
      entabla.addEventListener('mouseover', szinez);
    }
  }
}
