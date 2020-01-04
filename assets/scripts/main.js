"use strict";

const forms = document.querySelectorAll(".form");

forms.forEach(form => {
  form.addEventListener("submit", event => {
    event.preventDefault();
    let button = event.currentTarget.querySelector(".like-button");
    let likeCounter = event.currentTarget.querySelector(".like-counter");

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

/* show image before upload */

const inpFile = document.getElementById("input-file");
const previewContainer = document.getElementById("image-id-preview");
const previewImage = previewContainer.querySelector(".image-preview-image");
const previewDefaultText = previewContainer.querySelector(
  ".image-preview-default-text"
);

inpFile.addEventListener("change", function() {
  const file = this.files[0];

  if (file) {
    const reader = new FileReader();

    previewDefaultText.style.display = "none";
    previewImage.style.display = "block";

    reader.addEventListener("load", function() {
      previewImage.setAttribute("src", this.result);
    });

    reader.readAsDataURL(file);
  } else {
    previewDefaultText.style.display = null;
    previewImage.style.display = null;
    previewImage.setAttribute("src", "");
  }
});
