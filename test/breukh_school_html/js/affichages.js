import { fetchData } from './logique.js';
import { students } from './donnees.js';
import { createElement, createStudentList } from './helpers.js';

export async function displayData() {
  const datas = await fetchData();

  const niveau = document.querySelector("#accordionFlushExample");
  const container = document.querySelector('.container');

  for (let i = 0; i < datas.length; i++) {
    const data = datas[i];
    let classesHTML = "";

    for (let j = 0; j < data.classe.length; j++) {
      classesHTML += `<div class="accordion-body classe" data-id="${data.classe[j]['classe_id']}">${data.classe[j].libelle}</div>`;
    }

    niveau.innerHTML += `
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-heading${data.id}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${data.id}" aria-expanded="false" aria-controls="flush-collapse${data.id}">
              ${data.libelle}
            </button>
          </h2>
          <div id="flush-collapse${data.id}" class="accordion-collapse collapse" aria-labelledby="flush-heading${data.id}" data-bs-parent="#accordionFlushExample">
            ${classesHTML}
          </div>
        </div>
      </div>
    `;
  }

  // Ajouter un écouteur d'événements à chaque élément de classe
  const classeElements = document.querySelectorAll('.classe');
  classeElements.forEach(function (classeElement) {
    classeElement.addEventListener('click', function (event) {
      let title = document.querySelector(".list-title")
      title.innerHTML = "Liste des élèves"
      container.removeChild(niveau);
      const studentList = createStudentList(students);
      container.appendChild(studentList);
    });
  });
}
