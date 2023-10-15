function getRandomColor() {
  const letters = "0123456789ABCDEF"; //Letters won't change, so it is a constant
  let color = "#";
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function changeHeaderColor() {
  const colorInput = getRandomColor();
  const element = document.getElementById("magicText"); //Get dom's element with ID
  element.style.color = colorInput;
}

setInterval(changeHeaderColor, 500); //Here you pass the function, not the string with the name
