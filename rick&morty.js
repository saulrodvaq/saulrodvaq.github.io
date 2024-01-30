document.addEventListener("DOMContentLoaded", () => {
  const characterList = document.getElementById("character-list");
  const characterTemplate = document.getElementById("character-template");
  let lastCharacterId = 0;

  async function fetchCharacterById(id) {
    const response = await fetch(
      `https://rickandmortyapi.com/api/character/${id}`
    );
    return response.json();
  }

  document.getElementById("spawn").addEventListener("click", async () => {
    lastCharacterId++;

    try {
      const character = await fetchCharacterById(lastCharacterId);
      const clone = characterTemplate.content.cloneNode(true);
      clone.querySelector("[data-id='character-name']").textContent =
        character.name;
      clone.querySelector("[data-id='character-image']").src = character.image;
      const listItem = document.createElement("li");
      listItem.appendChild(clone);
      characterList.appendChild(listItem);
    } catch (error) {
      alert("No hay más personajes disponibles.");
      lastCharacterId--;
    }
  });

  document.getElementById("clear").addEventListener("click", () => {
    var itemList = document.getElementById("character-list");
    itemList.replaceChildren();
    lastCharacterId = 0;
  });
});
