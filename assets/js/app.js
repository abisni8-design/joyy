document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".custom-navbar");
    window.addEventListener("scroll", function () {
        navbar.style.background = window.scrollY > 50
            ? "rgba(8,25,15,.97)"
            : "rgba(10,28,18,.88)";
    });

    document.querySelectorAll(".stat-number").forEach(counter => {
        const target = parseInt(counter.textContent);
        if (!target) return;
        counter.textContent = "0";
        let current = 0;
        const step = Math.max(1, Math.ceil(target / 50));
        const tick = () => {
            current += step;
            counter.textContent = current >= target ? target : current;
            if (current < target) requestAnimationFrame(tick);
        };
        tick();
    });
});