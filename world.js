document.addEventListener("DOMContentLoaded", () => {
    const result = document.getElementById("result");
    const input = document.getElementById("country");

    document.getElementById("lookup").addEventListener("click", () => {
        const c = input.value.trim();
        fetch("world.php?country=" + encodeURIComponent(c) + "&lookup=countries")
            .then(r => r.text())
            .then(t => result.innerHTML = t);
    });

    document.getElementById("lookup-cities").addEventListener("click", () => {
        const c = input.value.trim();
        fetch("world.php?country=" + encodeURIComponent(c) + "&lookup=cities")
            .then(r => r.text())
            .then(t => result.innerHTML = t);
    });
});
