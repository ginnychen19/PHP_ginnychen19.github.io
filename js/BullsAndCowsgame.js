/*
setvalue 函數會在遊戲開始時隨機生成 4 個不重複的數字，然後將這些數字顯示在網頁上。
setfinal 函數則是用於在玩家猜對答案時顯示提示信息。
myTimer 函數則是用於每秒計時的計時器功能。

在程式的最後，通過綁定按鈕的 onclick 事件來實現不同的操作：
點擊 "開始遊戲" 按鈕時，會啟動計時器並隨機生成答案。
點擊 "看答案" 按鈕時，會在彈出對話框中顯示答案。
點擊 "放棄重來" 按鈕時，會重新加載頁面。
點擊 "檢查答案" 按鈕時，會檢查玩家輸入的答案是否正確，並在網頁上顯示相應的提示信息。 
*/

function setvalue(idno) {
    var choose = document.getElementById('choose');
    choose.innerHTML = choose.innerHTML + idno;
}
function setfinal(idno) {
    var final = document.getElementById('final');
    final.innerHTML = final.innerHTML + idno;
}
var myVar;
var n = 0;
function myTimer() {
    n += 1; //每次n+1
    document.getElementById("n").innerHTML = n; //並輸出到上面id為n的文字<p>
}



var Answer;
var NumberRnd = [];
var ctn = 0;
document.getElementById("name").disabled = false;
document.getElementById("btn_name").disabled = false;
document.getElementById("btn_answer").disabled = true;
document.getElementById("btn_renew").disabled = true;
document.getElementById("btn_checkanswer").disabled = true;
document.getElementById("input_answer").disabled = true;
document.getElementById("btn_updategoal").disabled = true;


var cmdStart = document.getElementById("btn_start"); //遊戲開始
cmdStart.onclick = function () {


    myVar = setInterval(function () {
        myTimer()
    }, 1000);

    document.getElementById("btn_start").disabled = true;
    document.getElementById("name").disabled = true;
    document.getElementById("btn_name").disabled = true;
    document.getElementById("btn_answer").disabled = false;
    document.getElementById("btn_renew").disabled = false;
    document.getElementById("btn_checkanswer").disabled = false;
    document.getElementById("input_answer").disabled = false;

    for (var i = 0; i < 4; i++) {
        NumberRnd[i] = Math.floor(Math.random() * 10);;
        for (var j = 0; j < i; j++) {
            if (NumberRnd[i] == NumberRnd[j]) {
                i--;
                break;
            }
        }
    }

    Answer = NumberRnd;
    setvalue(Answer);
}

var cmdAnswer = document.getElementById("btn_answer"); //看答案
cmdAnswer.onclick = function () {
    document.getElementById("btn_start").disabled = true;
    console.log("答案是：" + Answer);
    alert(Answer);
}


var cmdRenew = document.getElementById("btn_renew"); //放棄重來
cmdRenew.onclick = function () {
    window.location.reload();
}

var cmdCheckanswer = document.getElementById("btn_checkanswer"); //檢查答案

cmdCheckanswer.onclick = function () {
    document.getElementById("btn_start").disabled = true;


    if (document.getElementById("input_answer").value.length == 4) {
        var Dictionary = new Array();
        var A = 0,
            B = 0;
        var getInput = document.getElementById("input_answer").value; //取整數
        var Thousand = Math.floor(getInput / 1000);
        var Hundred = Math.floor((getInput % 1000) / 100);
        var Ten = Math.floor((getInput % 100) / 10);
        var Bit = Math.floor(getInput % 10);
        Dictionary[0] = Thousand;
        Dictionary[1] = Hundred;
        Dictionary[2] = Ten;
        Dictionary[3] = Bit;

        var ul = document.querySelector("#show_answer");
        for (var i = 0; i < 4; i++) {
            if (NumberRnd[i] == Dictionary[i]) {
                A++;
                if (A == 4) {
                    last_ctn = str(ctn)
                    clearInterval(myVar); //==========停下時間=============
                    console.log("過關！");
                    //alert ("恭喜！你猜對了！");
                    setfinal("恭喜過關！上傳你的成績吧");
                    //window.location.reload();
                    document.getElementById("btn_updategoal").disabled = false;
                }
            } else {
                for (var j = 0; j < 4; j++) {
                    if (NumberRnd[i] == Dictionary[j]) {
                        B++;
                    }
                }
            }
        }
        var li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center hover";
        li.innerText = document.getElementById("input_answer").value;
        var span = document.createElement("span");
        ctn++;
        span.className = "badge badge-secondary badge-pill text_size";
        span.innerText = "第" + ctn + "次回覆：" + A + "A" + B + "B";
        li.appendChild(span);
        ul.appendChild(li);
    } else {
        alert("請輸入四位數(不重複)");
    }
}

