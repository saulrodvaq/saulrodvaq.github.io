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

  async function handleCardClick(event) {
    const card = event.currentTarget;
    const isClicked = card.classList.contains("clicked");

    if (isClicked) {
      card.classList.remove("clicked");
      document.querySelector(".overlay").style.display = "none";
    } else {
      const characterName = card.querySelector(
        "[data-id='character-name']"
      ).textContent;
      const characterStatus = card.querySelector(
        "[data-id='character-status']"
      ).textContent;
      const characterSpecies = card.querySelector(
        "[data-id='character-species']"
      ).textContent;
      const characterType = card.querySelector(
        "[data-id='character-type']"
      ).textContent;
      const characterGender = card.querySelector(
        "[data-id='character-gender']"
      ).textContent;
      const characterOrigin = card.querySelector(
        "[data-id='character-origin']"
      ).textContent;
      const characterLocation = card.querySelector(
        "[data-id='character-location']"
      ).textContent;
      const characterEpisode = card.querySelector(
        "[data-id='character-episode']"
      ).textContent;
      const episodeResponse = await fetch(characterEpisode);
      const episodeData = await episodeResponse.json();
      const statusElement = document.querySelector(
        ".overlay [data-id='character-status']"
      );
      statusElement.innerHTML =
        "Status: " + "<span>" + characterStatus + "</span>";

      if (characterStatus === "Dead") {
        statusElement.querySelector("span").style.color = "red";
      } else if (characterStatus === "Alive") {
        statusElement.querySelector("span").style.color = "limegreen";
      }
      document.querySelector(
        ".overlay [data-id='character-name']"
      ).textContent = characterName;
      document.querySelector(
        ".overlay [data-id='character-species']"
      ).textContent = "Specie: " + characterSpecies;
      document.querySelector(
        ".overlay [data-id='character-type']"
      ).textContent = characterType === "" ? "" : "Type: " + characterType;
      document.querySelector(
        ".overlay [data-id='character-gender']"
      ).textContent = "Gender: " + characterGender;
      document.querySelector(
        ".overlay [data-id='character-origin']"
      ).textContent = "Origin: " + characterOrigin;
      document.querySelector(
        ".overlay [data-id='character-location']"
      ).textContent = "Location: " + characterLocation;
      document.querySelector(
        ".overlay [data-id='character-episode']"
      ).textContent = "First seen: " + episodeData.name;
      card.classList.add("clicked");
      document.querySelector(".overlay").style.display = "block";
    }
  }

  document.getElementById("spawn").addEventListener("click", async () => {
    lastCharacterId++;

    try {
      const character = await fetchCharacterById(lastCharacterId);
      const clone = characterTemplate.content.cloneNode(true);
      clone.querySelector("[data-id='character-name']").textContent =
        character.name;
      clone.querySelector("[data-id='character-image']").src = character.image;
      clone.querySelector(
        "[data-id='character-status']"
      ).textContent = `${character.status}`;
      clone.querySelector(
        "[data-id='character-status']"
      ).textContent = `${character.status}`;
      clone.querySelector("[data-id='character-type']").textContent =
        character.type;
      clone.querySelector("[data-id='character-gender']").textContent =
        character.gender;
      clone.querySelector("[data-id='character-species']").textContent =
        character.species;
      clone.querySelector("[data-id='character-origin']").textContent =
        character.origin.name;
      clone.querySelector("[data-id='character-location']").textContent =
        character.location.name;
      clone.querySelector("[data-id='character-episode']").textContent =
        character.episode[0];
      const listItem = document.createElement("li");
      listItem.appendChild(clone);
      characterList.appendChild(listItem);

      VanillaTilt.init(listItem.querySelectorAll("[data-tilt]"), {
        glare: true,
        "max-glare": 0.5,
      });
      VanillaTilt.init(listItem.querySelectorAll("[data-tilt-glare]"), {
        glare: {
          maxOpacity: 0.5,
        },
      });

      listItem
        .querySelector(".card")
        .addEventListener("click", handleCardClick);
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
