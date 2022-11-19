const avatarChoice = document.querySelectorAll(".avatar-choice");


avatarChoice.forEach((userAvatar) => {
  avatarChoice[0].classList.add("avatar-active");
  userAvatar.addEventListener("click", () => {
    removeAvatarActive();
    userAvatar.classList.add("avatar-active");
  });

  userAvatar.addEventListener("click", function () {
    ref_avatar.value = this.dataset.value;
  });
});

const removeAvatarActive = () => {
  avatarChoice.forEach((userAvatar) => {
    userAvatar.classList.remove("avatar-active");
  });
};
