// logique.js

import { url, students } from './donnees.js';

export async function fetchData() {
  const response = await fetch(url, {
    method: "GET",
    headers: {
      "Accept": "application/json",
    },
  });

  const datas = await response.json();
  return datas.data;
}
