"use strict";

const buttonEditPost = document.querySelector(".editPostimg");
const div = document.createElement("div");

buttonEditPost.addEventListener("click", () => {
  const template = `
  <label for="post">Choose a image to upload</label>
  <input type="file" name="post" accept=".png, .jpg, .jpeg" required>
  `;

  div.innerHTML = template;
  document.querySelector(".editPost").prepend(div);
});
