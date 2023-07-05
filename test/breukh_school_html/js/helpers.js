export function createElement(tagname, attributes = {}) {
    const element = document.createElement(tagname);
  
    for (let [attr, value] of Object.entries(attributes)) {
      element.setAttribute(attr, value);
    }
  
    return element;
  }
  
  export function createStudentList(students) {
    const table = createElement('table', { class: 'table table-striped table-light' });
    const tableHead = createElement('thead');
    const tableBody = createElement('tbody');
  
    // Créer l'en-tête du tableau
    const headerRow = createElement('tr');
    const headers = ['Prénom', 'Nom', 'Classe'];
  
    for (let headerText of headers) {
      const th = createElement('th', { class: 'text-primary' });
      th.textContent = headerText;
      headerRow.appendChild(th);
    }
  
    tableHead.appendChild(headerRow);
    table.appendChild(tableHead);
  
    // Créer les lignes du corps du tableau pour chaque élève
    for (let student of students) {
      const studentRow = createElement('tr');
  
      const firstNameCell = createElement('td');
      firstNameCell.textContent = student.prenom;
      studentRow.appendChild(firstNameCell);
  
      const lastNameCell = createElement('td');
      lastNameCell.textContent = student.nom;
      studentRow.appendChild(lastNameCell);
  
      const classCell = createElement('td');
      classCell.textContent = student.classe;
      studentRow.appendChild(classCell);
  
      tableBody.appendChild(studentRow);
    }
  
    table.appendChild(tableBody);
  
    return table;
  }
  