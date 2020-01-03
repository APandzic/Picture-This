"use strict";

const forms = document.querySelectorAll(".form");

forms.forEach(form => {
  form.addEventListener("submit", event => {
    event.preventDefault();
    let button = event.currentTarget.querySelector(".likeButton");
    let likeCounter = event.currentTarget.querySelector(".likeCounter");

    const formData = new FormData(form);

    fetch("/app/posts/like-posts.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(json => {
        likeCounter.innerHTML = json.counts;
        if (button.innerHTML === "like") {
          button.innerHTML = "unlike";
        } else {
          button.innerHTML = "like";
        }
      })
      .catch(console.error);
  });
});
