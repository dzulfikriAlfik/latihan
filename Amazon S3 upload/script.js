console.log("Called");

const imageForm = document.querySelector("#imageForm");
const imageInput = document.querySelector("#imageInput");

imageForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const file = imageInput.files[0];

  // console.log(file);

  const url = `https://dzulfikristorage.s3.ap-southeast-3.amazonaws.com/coba-${file.name}`;
  console.log(url);

  await fetch(url, {
    method: "PUT",
    headers: {
      "Content-Type": "multipart/form-data",
    },
    body: file,
  });

  // const imageUrl = url.split("?")[0];
  // console.log(imageUrl);
});
