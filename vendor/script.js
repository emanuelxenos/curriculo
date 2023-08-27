let jogo=document.getElementById("jogo");
let sla
let c=document.getElementById("img");
onload=function(){
    jogo.innerHTML=""
    c.src="imagens/x.png"
    sla="x"
for(var i=0;i<9;i++){
let canvas=document.createElement("canvas")
canvas.id=i
canvas.height=50
canvas.width=50
canvas.onclick=f
canvas.setAttribute("ok",false)
jogo.appendChild(canvas)
}
}
function f(e){
    e.target.setAttribute("k",sla)
    if(sla=="x"){
        if(okk(e)==1)
        return
        x(e)
        sla="o"
        c.src="imagens/o.png"
        return;
    }
    if(okk(e)==1)
    return
    y(e)
    sla="x"
    c.src="imagens/x.png"
}
function x(e){
    ctx=e.target.getContext("2d")
    ctx.moveTo(0,0);
    ctx.lineTo(50,50);
    ctx.moveTo(50,0);
    ctx.lineTo(0,50)
    ctx.lineWidth=5
    ctx.strokeStyle="blue"
    ctx.stroke();
    e.target.setAttribute("ok",true)
    setTimeout(ganhou,50)
}
function y(e){
    ctx=e.target.getContext("2d")
    ctx.arc(25, 25, 20, 0, 2 * Math.PI);
    ctx.lineWidth=5
    ctx.strokeStyle="red"
    ctx.stroke();
    e.target.setAttribute("ok",true)
    setTimeout(ganhou,50)
}
function okk(e){
    let canva=e.target
    let ok=canva.getAttribute("ok")
    if(ok=="true")
        return 1;
}
let a=[]
function ganhou(){
    for(let i=0;i<9;i++){
    a[i]=document.getElementById(i).getAttribute("k")
    }
    if(((a[0]==a[1]&&a[0]==a[2])||(a[0]==a[3]&&a[0]==a[6]))&&(a[0]!=null))
    ganhei(a[0])
    else if(((a[3]==a[4]&&a[3]==a[5])||(a[4]==a[1]&&a[1]==a[7])||(a[4]==a[2]&&a[2]==a[6])||(a[0]==a[4]&&a[0]==a[8]))&&(a[4]!=null))
    ganhei(a[4])
    else if(((a[6]==a[7]&&a[6]==a[8])||(a[2]==a[5]&&a[2]==a[8]))&&(a[8]!=null))
    ganhei(a[8])
    let k=0
    for(let i=0;i<9;i++){
        if(document.getElementById(i).getAttribute("ok")=="true")
        k++
        if(k==9)
        velha()
    }
}
function ganhei(e){
    alert(e+" ganhou")
    onload()
}
function velha(){
    alert("Deu velha")
    onload()
}

