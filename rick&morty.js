<<<<<<< HEAD


document.addEventListener("DOMContentLoaded", () => {
  fetch("https://rickandmortyapi.com/api/character")
    .then((response) => response.json())
    .then((data) => {
      const characters = data.results;
      characters.forEach((character) => {
        console.log(character.name);
      });
    });
=======
document.addEventListener("DOMContentLoaded", () => {
  fetch("https://rickandmortyapi.com/api/character").then(response => response.json()).then(data => {
  const characters = data.results;
  characters.forEach(character => {
    console.log(character.name);
    
  });    
  }) 
>>>>>>> 255090067414716628685799767b6bd9ed270944
});
