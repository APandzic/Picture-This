"use strict";

const forms = document.querySelectorAll(".form");

//like buttom
forms.forEach(form => {
  form.addEventListener("submit", event => {
    event.preventDefault();
    const button = event.currentTarget.querySelector(".like-button");
    const likeCounter = event.currentTarget.querySelector(".like-counter");

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

// follow buttom
const formFollow = document.querySelector(".form-follow");
if (formFollow) {
  formFollow.addEventListener("submit", event => {
    event.preventDefault();
    const button = event.currentTarget.querySelector(".follow-button");
    const followCounter = document.querySelector(".follow-counter");
    const formData = new FormData(formFollow);

    fetch("/app/users/follow-users.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(json => {
        followCounter.innerHTML = json.counts;
        if (button.innerHTML === "follow") {
          button.innerHTML = "unfollow";
        } else {
          button.innerHTML = "follow";
        }
      })
      .catch(console.error);
  });
}

// show image before upload

const inpFile = document.getElementById("input-file");
const previewContainer = document.getElementById("image-id-preview");
const previewImage = document.querySelector(".image-preview-image");
const previewDefaultText = document.querySelector(
  ".image-preview-default-text"
);

if (inpFile) {
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
}

// Replace old avatar with new before change

const inputFileAvatar = document.getElementById("input-file-edit-avatar");
const imageEditAvatar = document.querySelector(".image-edit-avatar");

if (inputFileAvatar) {
  inputFileAvatar.addEventListener("change", function() {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.addEventListener("load", function() {
        imageEditAvatar.setAttribute("src", "");
        imageEditAvatar.setAttribute("src", this.result);
      });
      reader.readAsDataURL(file);
    }
  });
}

// search result

const searchForm = document.querySelector(".search-form");
const searchInput = document.querySelector(".search-input");
if (searchForm) {
  searchForm.addEventListener("input", event => {
    event.preventDefault();
    const searchData = new FormData(searchForm);

    fetch("/app/users/search.php", {
      method: "POST",
      body: searchData
    })
      .then(response => response.json())
      .then(json => {
        document.getElementById("search-viewer").innerHTML = "";
        json.users.forEach(element => {
          const template = `
          <div class="container-search-viewer">
          <div class="container-img-avatar">
          <img class="img-avatar" src="/img-avatar/${element.profile_avatar}" alt="avatar">
          </div>
          <a class="hyperlink-username" href="home.php?id=${element.id}">${element.username}</a>
          </div>`;
          document.getElementById("search-viewer").innerHTML += template;
        });
      })
      .catch(console.error);
  });
}

// live search result

if (searchInput) {
  searchInput.addEventListener("keyup", event => {
    event.preventDefault();
    const searchData = new FormData(searchForm);

    fetch("/app/users/search.php", {
      method: "POST",
      body: searchData
    })
      .then(response => response.json())
      .then(json => {
        console.log(json);
        document.getElementById("search-viewer").innerHTML = "";

        if (json.users != "no users") {
          json.users.forEach(element => {
            console.log(element.id);
            const template = `
            <div class="container-search-viewer">
            <div class="container-img-avatar">
            <img class="img-avatar" src="/img-avatar/${element.profile_avatar}" alt="avatar">
            </div>
            <a class="hyperlink-username" href="home.php?id=${element.id}">${element.username}</a>
            </div>`;
            document.getElementById("search-viewer").innerHTML += template;
          });
        }
      })
      .catch(console.error);
  });
}
