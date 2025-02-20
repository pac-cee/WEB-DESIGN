/*
let userName = prompt("Enter your name to continue"); 
const passWord = prompt("Enter your password to continue"); 
if (passWord == null|| passWord==""){
   console.log("You must enter your password to continue");
   window.location = "Lesson1.html";
}
else{
 alert("Welcome " + userName + "!");
}
 function Check(){
    document.getElementById('day').innerHTML="Mastering Java Script";
  }
*/
// ...existing code...
function Calcul(){
    let act = document.getElementById('class').value;
    let mid = document.getElementById('mid').value;
    let fin = document.getElementById('fin').value;
    let product = act * mid * fin;
    document.getElementById('result').value = product; // Changed to set value instead of innerHTML
}
// ...existing code...