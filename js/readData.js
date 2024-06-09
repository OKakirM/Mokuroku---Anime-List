import data from "./data.json" with { type: "json" };
const date = new Date();
let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

let currentDate = `${day}/${month}/${year}`

if(document.getElementsByName("date")){
  for(let i = 0; i<document.getElementsByName("date").length; i++){
  document.getElementsByName("date")[i].innerHTML = currentDate;
  }
}