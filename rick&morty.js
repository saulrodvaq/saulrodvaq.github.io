document.addEventListener("DOMContentLoaded", () => {
  fetch("https://rickandmortyapi.com/api/character").then(response => response.json()).then(data => {
  const characters = data.results;
  characters.forEach(character => {
    console.log(character.name);
    
  });    
  }) 
});
