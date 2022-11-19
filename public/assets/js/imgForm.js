// -------------------------------------
// ---------------------Preview IMG
// -------------------------------------

// --------------------------------------------------------
// La fonction previewPicture
const previewPicture = (input, img) => {
  const [picture] = input.files;
  if (picture) {
    img.src = URL.createObjectURL(picture);
  }
};

// PictureMainView
pictureMainView.addEventListener("change", () => {
  previewPicture(pictureMainView, previewMainView);
});

// --------------------------------------------------------
// PictureMainView
picture1.addEventListener("change", () => {
  previewPicture(picture1, previewPicture1);
});

// --------------------------------------------------------
// PictureMainView
picture2.addEventListener("change", () => {
  previewPicture(picture2, previewPicture2);
});

