document.addEventListener("DOMContentLoaded", () => {
  const characterList = document.getElementById("character-list");
  const characterTemplate = document.getElementById("character-template");
  let lastCharacterId = 0;

  async function fetchCharacterById(id) {
    const response = await fetch(`https://rickandmortyapi.com/api/character/${id}`);
    return response.json();
  }

  function updateStatusElement(characterStatus) {
    const statusElement = document.querySelector(".overlay [data-id='character-status']");
    statusElement.innerHTML = "Status: " + "<span>" + characterStatus + "</span>";

    const statusSpan = statusElement.querySelector("span");
    statusSpan.style.color = characterStatus === "Dead" ? "red" : "limegreen";
  }

  function updateOverlay(character) {
    const overlay = document.querySelector(".overlay");
    overlay.querySelector("[data-id='character-name']").textContent = character.name;
    overlay.querySelector("[data-id='character-species']").textContent = "Specie: " + character.species;
    overlay.querySelector("[data-id='character-type']").textContent = character.type === "" ? "" : "Type: " + character.type;
    overlay.querySelector("[data-id='character-gender']").textContent = "Gender: " + character.gender;
    overlay.querySelector("[data-id='character-origin']").textContent = "Origin: " + character.origin.name;
    overlay.querySelector("[data-id='character-location']").textContent = "Location: " + character.location.name;
  }

  async function handleCardClick(event) {
    const card = event.currentTarget;
    const isClicked = card.classList.contains("clicked");

    if (isClicked) {
      card.classList.remove("clicked");
      document.querySelector(".overlay").style.display = "none";
    } else {
      const characterStatus = card.querySelector("[data-id='character-status']").textContent;
      updateStatusElement(characterStatus);
      
      const characterEpisode = card.querySelector("[data-id='character-episode']").textContent;
      const episodeResponse = await fetch(characterEpisode);
      const episodeData = await episodeResponse.json();
      
      const character = await fetchCharacterById(lastCharacterId);
      updateOverlay(character);
      
      document.querySelector(".overlay [data-id='character-episode']").textContent = "First seen: " + episodeData.name;
      card.classList.add("clicked");
      document.querySelector(".overlay").style.display = "block";
    }
  }

  async function spawnCharacter() {
    lastCharacterId++;

    try {
      const character = await fetchCharacterById(lastCharacterId);
      const clone = characterTemplate.content.cloneNode(true);

      clone.querySelector("[data-id='character-name']").textContent = character.name;
      clone.querySelector("[data-id='character-image']").src = character.image;
      clone.querySelector("[data-id='character-status']").textContent = `${character.status}`;
      clone.querySelector("[data-id='character-type']").textContent = character.type;
      clone.querySelector("[data-id='character-gender']").textContent = character.gender;
      clone.querySelector("[data-id='character-species']").textContent = character.species;
      clone.querySelector("[data-id='character-origin']").textContent = character.origin.name;
      clone.querySelector("[data-id='character-location']").textContent = character.location.name;
      clone.querySelector("[data-id='character-episode']").textContent = character.episode[0];

      const listItem = document.createElement("li");
      listItem.classList.add("cardcontainer");
      listItem.appendChild(clone);
      characterList.appendChild(listItem);

      VanillaTilt.init(listItem.querySelectorAll("[data-tilt]"), { glare: true, "max-glare": 0.5 });
      VanillaTilt.init(listItem.querySelectorAll("[data-tilt-glare]"), { glare: { maxOpacity: 0.5 } });

      listItem.querySelector(".card").addEventListener("click", handleCardClick);
    } catch (error) {
      alert("No hay más personajes disponibles.");
      lastCharacterId--;
    }
  }

  document.getElementById("spawn").addEventListener("click", spawnCharacter);

  document.getElementById("clear").addEventListener("click", () => {
    characterList.replaceChildren();
    lastCharacterId = 0;
  });
});