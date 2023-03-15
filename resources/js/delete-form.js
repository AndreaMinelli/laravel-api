const forms = document.querySelectorAll(".delete-form");

forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const confirmed = confirm("Sei sicuro di voler eliminare?");
        if (confirmed) form.submit();
    });
});
