window.onload = () => {
  const lookupBtn = document.getElementById("lookup");
  const lookupCitiesBtn = document.getElementById("lookup-cities");
  const result = document.getElementById("result");
  const input = document.getElementById("country");

  lookupBtn.onclick = () => {
    fetch(`world.php?country=${input.value}`)
      .then(res => res.text())
      .then(data => result.innerHTML = data);
  };

  lookupCitiesBtn.onclick = () => {
    fetch(`world.php?country=${input.value}&lookup=cities`)
      .then(res => res.text())
      .then(data => result.innerHTML = data);
  };
};
