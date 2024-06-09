import data from "./data.json" with { type: "json" };
const date = new Date();
let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

let currentDate = `${day}/${month}/${year}`

// One Piece Section
if(document.getElementById("oneCover")){
  document.getElementById("oneCover").src = data["Anime"]["one_piece"]["images"][0]["cover"];
}
if(document.getElementById("oneBanner")) {
  document.getElementById("oneBanner").src = data["Anime"]["one_piece"]["images"][0]["banner"];
}
if(document.getElementById("oneTitle")) {
  document.getElementById("oneTitle").innerHTML = data["Anime"]["one_piece"]["details"][0]["name"]
}

if(document.getElementById("oneSinopse")) {
  document.getElementById("oneSinopse").innerHTML = data["Anime"]["one_piece"]["details"][0]["sinopse"]
}

if(document.getElementById("oneEp")) {
  document.getElementById("oneEp").innerHTML = data["Anime"]["one_piece"]["details"][0]["ep"]
}

if(document.getElementById("oneFormat")) {
  document.getElementById("oneFormat").innerHTML = data["Anime"]["one_piece"]["details"][0]["format"]
}

if(document.getElementById("oneDuration")) {
  document.getElementById("oneDuration").innerHTML = data["Anime"]["one_piece"]["details"][0]["ep-duration"]
}

if(document.getElementById("oneStatus")) {
  document.getElementById("oneStatus").innerHTML = data["Anime"]["one_piece"]["details"][0]["stats"]
}

if(document.getElementById("oneSDate")) {
  document.getElementById("oneSDate").innerHTML = data["Anime"]["one_piece"]["details"][0]["sDate"]
}

if(document.getElementById("oneSeason")) {
  document.getElementById("oneSeason").innerHTML = data["Anime"]["one_piece"]["details"][0]["season"]
}

if(document.getElementById("oneScore")) {
  document.getElementById("oneScore").innerHTML = data["Anime"]["one_piece"]["details"][0]["score"]
}

if(document.getElementById("oneStudio")) {
  document.getElementById("oneStudio").innerHTML = data["Anime"]["one_piece"]["details"][0]["studio"]
}

if(document.getElementById("oneGenres")) {
  for(let i = 0; i < data["Anime"]["one_piece"]["details"][0]["genres"].length; i++){
    document.getElementById("oneGenres").innerHTML += "<p class='font-Poppins c-white5'>"+data["Anime"]["one_piece"]["details"][0]["genres"][i]+"</p>";
  }
}


// DBZ Section
if(document.getElementById("dbzCover")){
  document.getElementById("dbzCover").src = data["Anime"]["dbz"]["images"][0]["cover"];
}

if(document.getElementById("dbzBanner")) {
  document.getElementById("dbzBanner").src = data["Anime"]["dbz"]["images"][0]["banner"];
}

// KNY Section
if(document.getElementById("knyCover")){
  document.getElementById("knyCover").src = data["Anime"]["kny"]["images"][0]["cover"];
}

if(document.getElementById("knyBanner")){
  document.getElementById("knyBanner").src = data["Anime"]["kny"]["images"][0]["banner"];
}


// Aot Section
if(document.getElementById("aotCover")){
  document.getElementById("aotCover").src = data["Anime"]["aot"]["images"][0]["cover"];
}

if(document.getElementById("aotBanner")){
  document.getElementById("knyBanner").src = data["Anime"]["aot"]["images"][0]["banner"];
}

// JJK Section
if(document.getElementById("jjkCover")){
  document.getElementById("jjkCover").src = data["Anime"]["jjk"]["images"][0]["cover"];
}

if(document.getElementById("jjkBanner")){
  document.getElementById("jjkBanner").src = data["Anime"]["jjk"]["images"][0]["banner"];
}

if(document.getElementById("date")){
  document.getElementById("date").innerHTML = currentDate;
}


